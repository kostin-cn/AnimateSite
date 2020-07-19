<?php
/* @var $this yii\web\View */
/* @var $model common\entities\Order */

$this->title = 'Изменить: ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="order-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
