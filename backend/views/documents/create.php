<?php
/* @var $this yii\web\View */
/* @var $model common\entities\Documents */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-item-documents-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
