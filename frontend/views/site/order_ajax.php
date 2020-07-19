<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;

use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model \common\entities\Order */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="order-form row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h3><?= Yii::t('app', 'Зарезервировать');?></h3>

            <?php $form = ActiveForm::begin(['options'=>['id'=>'reservation']]); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                'mask' => '+9 (999) 999-99-99',
            ]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'date_form')->widget(
                        DatePicker::class, [
                        'language' => Yii::$app->language,
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy',
                        ]
                    ]); ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'time_from')->input('time') ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'time_till')->input('time') ?>
                </div>
            </div>

            <?= $form->field($model, 'qty')->textInput() ?>

            <?= $form->field($model, 'notes')->textarea(); ?>

            <?php if (Yii::$app->user->isGuest): ; ?>
                <div class="captcha">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'captchaAction' => 'site/captcha',
                        'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-7">{input}</div></div>',
                    ]) ?>
                </div>
            <?php endif; ?>


            <div class="form-group">
                <?= Html::submitButton(Yii::t('app','Резерв') , ['class' => 'btn white']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-lg-3"></div>
    </div>




