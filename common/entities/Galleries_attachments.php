<?php

namespace common\entities;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%galleries_attachments}}".
 *
 * @property int $id
 * @property int $gallery_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property int $size
 * @property string $name
 * @property int $order
 *
 * @property Galleries $gallery
 */
class Galleries_attachments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%galleries_attachments}}';
    }

    public function rules()
    {
        return [
            [['gallery_id'], 'required'],
            [['gallery_id', 'size', 'order'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Galleries::className(), 'targetAttribute' => ['gallery_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gallery_id' => 'Gallery ID',
            'path' => 'Path',
            'base_url' => 'Base Url',
            'type' => 'Type',
            'size' => 'Size',
            'name' => 'Name',
            'order' => 'Order',
        ];
    }

    public function getGallery()
    {
        return $this->hasOne(Galleries::className(), ['id' => 'gallery_id']);
    }

    public function getUrl()
    {
        return $this->base_url . '/' . $this->path;
    }
}
