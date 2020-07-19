<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\Contacts */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-2">
                    <?= $form->field($model, 'type')->dropDownList($model::VARIANTS) ?>
                </div>
                <div class="col-lg-5">
                    <?= $form->field($model, 'value_ru')->textarea(); ?>
                </div>
                <div class="col-lg-5">
                    <?= $form->field($model, 'value_en')->textarea(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


