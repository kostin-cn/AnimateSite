<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\entities\Abouts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'О ресторане', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galleries-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' =>
        'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => 'Вы точно хотите удалить эту запись?',
        'method' => 'post',
        ],
        ]) ?>
        <?php if ($model->status) {
            echo Html::a('<span class="glyphicon glyphicon-ok"></span> Отображать', ['status', 'id' => $model->id], ['class' => 'btn btn-success btn-raised pull-right']);
        } else {
            echo Html::a('<span class="glyphicon glyphicon-remove"></span> Скрывать', ['status', 'id' => $model->id], ['class' => 'btn btn-danger btn-raised pull-right']);
        }; ?>
    </p>
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <?= $model->image_name ? DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Изображение',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    if ($data->image_name) {
                                        return Html::img($data->image, [
                                            'alt' => 'yii2 - картинка в gridview',
                                            'style' => 'width:100%;'
                                        ]);
                                    }
                                    return null;
                                },
                            ],
                        ],
                    ]) : '' ?>
                </div>
                <div class="col-lg-6">
                    <?php if ($model->gallery) {
                        foreach ($model->aboutsAttachments as $attachment) {
                            echo Html::img($attachment->getUrl(), ['style' => 'width:45%;margin:0 10px 10px 0;']);
                        }
                    }; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title_ru',
                            'html_ru',
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title_en',
                            'html_en',
                        ],
                    ]) ?>
                </div>
            </div>

        </div>
    </div>
</div>
