<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\entities\Events;

/* @var $this yii\web\View */
/* @var $model common\entities\Events */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости и события', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Изображение',
                        'format' => 'raw',
                        'value' => function (Events $data) {
                            if ($data->image_name) {
                                return Html::img($data->image, [
                                    'alt' => 'yii2 - картинка в gridview',
                                    'style' => 'width:500px;'
                                ]);
                            }
                            return null;
                        },
                    ],
                    [
                        'attribute' => 'date',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Yii::$app->formatter->asDate($data->date, 'dd.MM.yyyy');
                        },
                    ],
                ],
            ]) ?>
            <div class="row">
                <div class="col-lg-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title_ru',
                            'short_desc_ru',
                            [
                                'attribute' => 'html_ru',
                                'format' => 'raw'
                            ],
                        ]
                    ]) ?>
                </div>
                <div class="col-lg-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title_en',
                            'short_desc_en',
                            [
                                'attribute' => 'html_en',
                                'format' => 'raw'
                            ],
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'meta_title_ru',
                            'meta_description_ru',
                            'meta_keywords_ru',
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'meta_title_en',
                            'meta_description_en',
                            'meta_keywords_en',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
