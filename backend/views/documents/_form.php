<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\Documents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-item-documents-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'uploadedFile_ru')->fileInput(['accept' => '.pdf, .zip, .rar']) ?>
                    <?= $form->field($model, 'file_name_ru')->textInput(['disabled' => 'disabled'])->label(false) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'uploadedFile_en')->fileInput(['accept' => '.pdf, .zip, .rar']) ?>
                    <?= $form->field($model, 'file_name_en')->textInput(['disabled' => 'disabled'])->label(false) ?>
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
