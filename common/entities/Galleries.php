<?php

namespace common\entities;

use Yii;
use \yii\db\ActiveRecord;
use trntv\filekit\behaviors\UploadBehavior;
use backend\components\SortableBehavior;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%galleries}}".
 *
 * @property int $id
 * @property string $title
 * @property string $title_ru
 * @property string $title_en
 * @property string $slug
 * @property string $html
 * @property string $html_ru
 * @property string $html_en
 * @property int $sort
 * @property int $status
 * @property int $gallery
 *
 * @property Galleries_attachments[] $galleriesAttachments
 */
class Galleries extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%galleries}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'galleriesAttachments',
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
            [['title_ru', 'title_en', 'slug', 'html_ru', 'html_en'], 'string', 'max' => 255],
            [['attachments'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => 'Заголовок Ru',
            'title_en' => 'Заголовок En',
            'slug' => 'Slug',
            'html_ru' => 'Текст Ru',
            'html_en' => 'Текст En',
            'sort' => 'Сортировка',
            'status' => 'Статус',
            'gallery' => 'Изображения',
            'attachments' => 'Изображения',
        ];
    }

    public function getGalleriesAttachments()
    {
        return $this->hasMany(Galleries_attachments::className(), ['gallery_id' => 'id']);
    }

    public function getTitle()
    {
        return $this->getAttr('title');
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

}
