<?php

namespace common\entities;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%modules_attachments}}".
 *
 * @property int $id
 * @property int $module_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property int $size
 * @property string $name
 * @property int $order
 *
 * @property Modules $module
 */
class Modules_attachments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%modules_attachments}}';
    }

    public function rules()
    {
        return [
            [['module_id'], 'required'],
            [['module_id', 'size', 'order'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modules::className(), 'targetAttribute' => ['module_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_id' => 'Modules ID',
            'path' => 'Path',
            'base_url' => 'Base Url',
            'type' => 'Type',
            'size' => 'Size',
            'name' => 'Name',
            'order' => 'Order',
        ];
    }

    public function getModule()
    {
        return $this->hasOne(Modules::className(), ['id' => 'module_id']);
    }

    public function getUrl()
    {
        return $this->base_url . '/' . $this->path;
    }
}
