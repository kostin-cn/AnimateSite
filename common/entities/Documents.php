<?php

namespace common\entities;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use backend\components\SortableBehavior;

/**
 * This is the model class for table "{{%documents}}".
 *
 * @property int $id
 * @property string $title
 * @property string $title_ru
 * @property string $title_en
 * @property string $extension
 * @property string $file_name
 * @property string $file_name_ru
 * @property string $file_name_en
 * @property int $sort
 * @property int $status
 *
 * @property UploadedFile $uploadedFile_ru
 * @property UploadedFile $uploadedFile_en
 * @property string $file
 * @property string $file_ru
 * @property string $file_en
 */
class Documents extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%documents}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SortableBehavior::class,
            ],
        ];
    }

    public function rules()
    {
        return array_filter([
            [['title_ru', 'file_name_ru'], 'required'],
            [['sort', 'status'], 'integer'],
            [['title_ru', 'title_en'], 'string', 'max' => 255],
            [['extension', 'file_name_ru', 'file_name_en'], 'string', 'max' => 50],

            [['uploadedFile_ru'], 'safe'],
            [['uploadedFile_ru'], 'file', 'extensions' => 'pdf, zip'],
            ['uploadedFile_ru', 'required', 'when' => function () {
                return !$this->file_name;
            }, 'whenClient' => true],

            [['uploadedFile_en'], 'safe'],
            [['uploadedFile_en'], 'file', 'extensions' => 'pdf, zip'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => 'Заголовок Ru',
            'title_en' => 'Заголовок En',
            'extension' => 'Extension',
            'file_name_ru' => 'Файл Ru',
            'uploadedFile_ru' => 'Файл Ru',
            'file_name_en' => 'Файл En',
            'uploadedFile_en' => 'Файл En',
            'sort' => 'Порядок',
            'status' => 'Статус',
        ];
    }

    public function getTitle()
    {
        return $this->getAttr('title');
    }

    public function getFile_name()
    {
        return $this->getAttr('file_name');
    }

    private function getAttr($attribute)
    {
        $attr = $attribute . '_' . Yii::$app->language;
        $def_attr = $attribute . '_' . Yii::$app->params['defaultLanguage'];
        return $this->$attr ?: $this->$def_attr;
    }

    #################### Files ####################

    public function __construct(array $config = [])
    {
        $folderName = str_replace(['{', '}', '%'], '', $this::tableName());
        parent::__construct($config);
        $this->_folder = '/files/' . $folderName . '/';
        $this->_folderPath = Yii::getAlias('@files') . '/' . $folderName . '/';
    }

    public $uploadedFile_ru;
    public $uploadedFile_en;
    private $_folder;
    private $_folderPath;

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->uploadedFile_en = UploadedFile::getInstance($this, 'uploadedFile_en');
            $this->uploadedFile_ru = UploadedFile::getInstance($this, 'uploadedFile_ru');
            if ($this->isNewRecord) {
                /* @var $lastModel self */
                $lastModel = self::find()->orderBy(['id' => SORT_DESC])->one();
                $id = $lastModel->id + 1;
            } else {
                $id = $this->id;
            }
            if ($this->uploadedFile_ru) {
                if (!$this->isNewRecord) {
                    $this->deleteFile_ru();
                }
                $this->file_name_ru = $id . '_RU_' . time() . '.' . $this->uploadedFile_ru->extension;
            }
            if ($this->uploadedFile_en) {
                if (!$this->isNewRecord) {
                    $this->deleteFile_en();
                }
                $this->file_name_en = $id . '_EN_' . time() . '.' . $this->uploadedFile_en->extension;
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->uploadedFile_ru) {
            $path = $this->_folderPath . $this->file_name_ru;
            FileHelper::createDirectory(dirname($path, 1));
            $this->uploadedFile_ru->saveAs($path);
        }
        if ($this->uploadedFile_en) {
            $path = $this->_folderPath . $this->file_name_en;
            FileHelper::createDirectory(dirname($path, 1));
            $this->uploadedFile_en->saveAs($path);
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->deleteFile_ru();
        $this->deleteFile_en();
    }

    public function deleteFile_ru()
    {
        if ($this->file_name_ru) {
            if (file_exists($this->_folderPath . $this->file_name_ru)) {
                unlink($this->_folderPath . $this->file_name_ru);
            }
        }
    }

    public function deleteFile_en()
    {
        if ($this->file_name_en) {
            if (file_exists($this->_folderPath . $this->file_name_en)) {
                unlink($this->_folderPath . $this->file_name_en);
            }
        }
    }

    public function getFile()
    {
        return $this->_folder . $this->file_name;
    }

    public function getFile_ru()
    {
        return $this->_folder . $this->file_name_ru;
    }

    public function getFile_en()
    {
        return $this->_folder . $this->file_name_en;
    }
}
