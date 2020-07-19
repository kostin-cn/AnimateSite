<?php
namespace backend\components\widget;

use trntv\filekit\widget\Upload;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: Daniel1250
 * Date: 20.12.2016
 * Time: 0:07
 */
class GalleryUpload extends Upload
{
    public function run()
    {
        $this->registerClientScript();
        $content = Html::beginTag('div');
        $content .= Html::hiddenInput($this->name, null, [
            'class' => 'empty-value',
            'id' => $this->options['id']
        ]);
        $content .= Html::fileInput($this->getFileInputName(), null, [
            'name' => $this->getFileInputName(),
            'id' => $this->getId(),
            'multiple' => $this->multiple,
            'accept' => 'image/*'
        ]);
        $content .= Html::endTag('div');
        return $content;
    }
}