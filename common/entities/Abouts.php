<?php

namespace common\entities;

use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use trntv\filekit\behaviors\UploadBehavior;
use backend\components\SortableBehavior;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%abouts}}".
 *
 * @property int $id
 * @property string $title
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property string $subTitle
 * @property string $sub_title_ru
 * @property string $sub_title_en
 * @property string $html
 * @property string $html_ru
 * @property string $html_en
 * @property int $sort
 * @property int $status
 * @property int $gallery
 * @property string $image_name
 *
 * @property UploadedFile uploadedImageFile
 * @property string $image
 *
 * @property Abouts_attachments[] $aboutsAttachments
 */
class Abouts extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%abouts}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'aboutsAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => SortableBehavior::class,
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title_ru',
                'ensureUnique' => true
            ],
        ];
    }

    public $attachments;

    public function rules()
    {
        return [
            [['title_ru'], 'required'],
            [['sort', 'status', 'gallery'], 'integer'],
            [['title_ru', 'title_en', 'sub_title_ru', 'sub_title_en', 'slug'], 'string', 'max' => 255],
            [['html_ru', 'html_en'], 'string'],
            [['image_name'], 'string', 'max' => 50],
            [['uploadedImageFile', 'attachments'], 'safe'],
            [['uploadedImageFile'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => 'Заголовок Ru',
            'title_en' => 'Заголовок En',
            'slug' => 'Slug',
            'sub_title_ru' => 'Подзаголовок Ru',
            'sub_title_en' => 'Подзаголовок En',
            'html_ru' => 'Текст Ru',
            'html_en' => 'Текст En',
            'sort' => 'Сортировка',
            'status' => 'Статус',
            'gallery' => 'Изображения',
            'attachments' => 'Изображения',
            'image_name' => 'Изображение',
            'image_file' => 'Изображение',
        ];
    }

    public function getAboutsAttachments()
    {
        return $this->hasMany(Abouts_attachments::className(), ['about_id' => 'id']);
    }

    public function getTitle()
    {
        return $this->getAttr('title');
    }

    public function getSubTitle()
    {
        return $this->getAttr('sub_title');
    }

    public function getHtml()
    {
        return $this->getAttr('html');
    }

    private function getAttr($attribute)
    {
        $attr = $attribute . '_' . Yii::$app->language;
        $def_attr = $attribute . '_' . Yii::$app->params['defaultLanguage'];
        return $this->$attr ?: $this->$def_attr;
    }


    #################### IMAGES ####################

    private $imageWidth = 1920;
    private $imageHeight = null;
    private $quality = 85;

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
                $this->image_name = $id . '.' . $this->uploadedImageFile->extension;
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
                Image::thumbnail($path, $this->imageWidth, $this->imageHeight)->save($path, ['quality' => $this->quality]);
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
