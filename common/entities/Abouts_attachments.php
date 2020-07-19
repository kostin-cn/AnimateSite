<?php

namespace common\entities;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%abouts_attachments}}".
 *
 * @property int $id
 * @property int $about_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property int $size
 * @property string $name
 * @property int $order
 *
 * @property Abouts $about
 */
class Abouts_attachments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%abouts_attachments}}';
    }

    public function rules()
    {
        return [
            [['about_id'], 'required'],
            [['about_id', 'size', 'order'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
            [['about_id'], 'exist', 'skipOnError' => true, 'targetClass' => Abouts::className(), 'targetAttribute' => ['about_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'about_id' => 'About ID',
            'path' => 'Path',
            'base_url' => 'Base Url',
            'type' => 'Type',
            'size' => 'Size',
            'name' => 'Name',
            'order' => 'Order',
        ];
    }

    public function getAbout()
    {
        return $this->hasOne(Abouts::className(), ['id' => 'about_id']);
    }

    public function getUrl()
    {
        return $this->base_url . '/' . $this->path;
    }
}
