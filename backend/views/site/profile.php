<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use trntv\filekit\widget\Upload;

/* @var $this yii\web\View */
/* @var $model \common\models\User */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Change Profile'
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-8">
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'middlename')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'picture')->widget(Upload::class, [
                'url' => ['avatar-upload']
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
