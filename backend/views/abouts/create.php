<?php
/* @var $this yii\web\View */
/* @var $model common\entities\Abouts */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'О ресторане', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galleries-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
