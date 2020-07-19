<?php

namespace common\entities;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%events}}".
 *
 * @property int $id
 * @property string $image_name
 * @property string $title
 * @property string $title_ru
 * @property string $title_en
 * @property string $shortDesc
 * @property string $short_desc_ru
 * @property string $short_desc_en
 * @property string $slug
 * @property string $date
 * @property string $html
 * @property string $html_ru
 * @property string $html_en
 * @property int $status
 *
 * @property string $meta_title
 * @property string $meta_title_ru
 * @property string $meta_title_en
 * @property string $meta_description
 * @property string $meta_description_ru
 * @property string $meta_description_en
 * @property string $meta_keywords
 * @property string $meta_keywords_ru
 * @property string $meta_keywords_en
 *
 * @property UploadedFile $uploadedImageFile
 * @property string $image
 * @property Events $prev
 * @property Events $next
 */
class Events extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%events}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title_ru',
                'ensureUnique' => true
            ],
        ];
    }

    public function rules()
    {
        return array_filter([
            [['image_name', 'title_ru', 'title_en', 'html_ru'], 'required'],
            [['html_ru', 'html_en'], 'string'],
            [['status'], 'integer'],
            [['image_name', 'date'], 'string', 'max' => 50],
            [['title_ru', 'title_en', 'slug', 'short_desc_ru', 'short_desc_en'], 'string', 'max' => 255],
            [['meta_title_ru', 'meta_title_en', 'meta_description_ru', 'meta_description_en', 'meta_keywords_ru', 'meta_keywords_en'], 'string', 'max' => 255],

            [['uploadedImageFile', 'datum'], 'safe'],
            [['uploadedImageFile'], 'file', 'extensions' => 'png, jpg, jpeg'],
            $this->isNewRecord ? ['uploadedImageFile', 'required'] : null,
        ]);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'datum' => 'Дата',
            'image_name' => 'Изображение',
            'uploadedImageFile' => 'Изображение',
            'title_ru' => 'Заголовок Ru',
            'title_en' => 'Заголовок En',
            'slug' => 'Slug',
            'short_desc_ru' => 'Короткий текст Ru',
            'short_desc_en' => 'Короткий текст En',
            'html_ru' => 'Текст Ru',
            'html_en' => 'Текст En',
            'status' => 'Статус',

            'meta_title_ru' => 'Meta Title Ru',
            'meta_title_en' => 'Meta Title En',
            'meta_description_ru' => 'Meta Description Ru',
            'meta_description_en' => 'Meta Description En',
            'meta_keywords_ru' => 'Meta Keywords Ru',
            'meta_keywords_en' => 'Meta Keywords En',
        ];
    }

    public function getTitle()
    {
        return $this->getAttr('title');
    }

    public function getShortDesc()
    {
        return $this->getAttr('short_desc');
    }

    public function getHtml()
    {
        return $this->getAttr('html');
    }


    public function getMeta_title()
    {
        return $this->getAttr('meta_title');
    }

    public function getMeta_description()
    {
        return $this->getAttr('meta_description');
    }

    public function getMeta_keywords()
    {
        return $this->getAttr('meta_keywords');
    }

    private function getAttr($attribute)
    {
        $attr = $attribute . '_' . Yii::$app->language;
        $def_attr = $attribute . '_' . Yii::$app->params['defaultLanguage'];
        return $this->$attr ?: $this->$def_attr;
    }

    public $datum;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->datum) {
                $i = strtotime($this->datum);
                $dates = ArrayHelper::getColumn(self::find()->andWhere(['not', ['id' => $this->id]])->asArray()->all(), 'date');
                while (in_array($i, $dates)) {
                    $i++;
                }
                $this->date = $i;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getPrev()
    {
        return Events::find()->orderBy(['date' => SORT_DESC])->having(['status' => 1])->andWhere(['<', 'date', $this->date])->one();
    }

    public function getNext()
    {
        return Events::find()->orderBy(['date' => SORT_ASC])->having(['status' => 1])->andWhere(['>', 'date', $this->date])->one();
    }

    #################### IMAGES ####################

    private $imageWidth = 1920;
    private $imageHeight = 650;

    public function __construct(array $config = [])
    {
        $folderName = str_replace(['{', '}', '%'], '', $this::tableName());
        parent::__construct($config);
        $this->_folder = '/files/' . $folderName . '/';
        $this->_folderPath = Yii::getAlias('@files') . '/' . $folderName . '/';
    }

    public $uploadedImageFile;
    private $_folder;
    private $_folderPath;

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->uploadedImageFile = UploadedFile::getInstance($this, 'uploadedImageFile');
            if ($this->uploadedImageFile) {
                if (!$this->isNewRecord) {
                    $this->deleteImage();
                }
                if (!$this->image_name) {
                    /* @var $lastModel self */
                    $lastModel = self::find()->orderBy(['id' => SORT_DESC])->one();
                    $id = $lastModel->id + 1;
                } else {
                    $id = $this->id;
                }
                $this->image_name = $id . '_' . time() . '.' . $this->uploadedImageFile->extension;
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->uploadedImageFile) {
            $path = $this->_folderPath . $this->image_name;
            FileHelper::createDirectory(dirname($path, 1));
            $this->uploadedImageFile->saveAs($path);
            if ($this->uploadedImageFile->extension != 'svg') {
                Image::thumbnail($path, $this->imageWidth, $this->imageHeight)->save($path);
            }
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->deleteImage();
    }

    public function deleteImage()
    {
        if ($this->image_name) {
            if (file_exists($this->_folderPath . $this->image_name)) {
                unlink($this->_folderPath . $this->image_name);
            }
        }
    }

    public function removeImage()
    {
        $this->deleteImage();
        $this->image_name = null;
        $this->save();
    }

    public function getImage()
    {
        return $this->_folder . $this->image_name;
    }
}
