<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model common\entities\Abouts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galleries-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box">
        <div class="box-body">

            <div class="row">
                <div class="col-lg-6">
                    <?php
                    $img = ($model->image_name) ? $model->image : '/files/default_thumb.png';
                    $label = Html::img($img, ['class' => 'preview_image_block', 'alt' => 'Image of ' . $model->id]) . "<span>Изображение</span>";
                    ?>
                    <?= $form->field($model, 'uploadedImageFile', ['options' => ['class' => 'img_input_block']])
                        ->fileInput(['class' => 'hidden-input img-input', 'accept' => 'image/*'])->label($label, ['class' => 'label-img']); ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'attachments')->widget(
                        'backend\components\widget\GalleryUpload',
                        [
                            'url' => ['file-storage/upload'],
                            'sortable' => true,
                            'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
                            'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
                            'maxNumberOfFiles' => 3,
                            'clientOptions' => []
                        ]
                    ); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'sub_title_ru')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'html_ru')->widget(Widget::class, [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 200,
                        ]
                    ]); ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'sub_title_en')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'html_en')->widget(Widget::class, [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 200,
                        ]
                    ]); ?>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
