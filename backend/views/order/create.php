<?php
/* @var $this yii\web\View */
/* @var $model common\entities\Order */
/* @var $restaurant common\entities\Contacts */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
