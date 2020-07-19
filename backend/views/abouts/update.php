<?php
/* @var $this yii\web\View */
/* @var $model common\entities\Abouts */

$this->title = 'Изменить: ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => 'О ресторане', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="galleries-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
