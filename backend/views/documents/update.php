<?php
/* @var $this yii\web\View */
/* @var $model common\entities\Documents */

$this->title = 'Изменить: ' . $model->title_ru;

$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title_ru, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="abouts-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
