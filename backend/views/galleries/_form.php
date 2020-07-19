<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\entities\Galleries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galleries-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'html_ru')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'html_en')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

        </div>
    </div>

    <?= $form->field($model, 'attachments')->widget(
        'backend\components\widget\GalleryUpload',
        [
            'url' => ['file-storage/upload'],
            'sortable' => true,
            'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
            'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
            'maxNumberOfFiles' => 20,
            'clientOptions' => []
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
