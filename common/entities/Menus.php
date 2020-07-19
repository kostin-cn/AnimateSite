<?php

namespace common\entities;

use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use backend\components\SortableBehavior;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%menus}}".
 *
 * @property int $id
 * @property string $title
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property int $sort
 * @property int $status
 * @property string $image_name
 *
 * @property UploadedFile uploadedImageFile
 * @property string $image
 */
class Menus extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%menus}}';
    }

    public function behaviors()
    {
        return [
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

    public function rules()
    {
        return [
            [['title_ru'], 'required'],
            [['sort', 'status'], 'integer'],
            [['title_ru', 'title_en', 'slug'], 'string', 'max' => 255],
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
            'sort' => 'Сортировка',
            'status' => 'Статус',
            'image_name' => 'Изображение',
            'image_file' => 'Изображение',
        ];
    }

    public function getTitle()
    {
        return $this->getAttr('title');
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
