<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\entities\Modules;

/* @var $this yii\web\View */
/* @var $model common\entities\Modules */

$this->title = $model->title_ru ?: 'Модуль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' =>
            'btn btn-primary']) ?>
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
                        foreach ($model->modulesAttachments as $attachment) {
                            echo Html::img($attachment->getUrl(), ['style' => 'width:45%;margin:0 10px 10px 0;']);
                        }
                    }; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title_ru',
                            [
                                'attribute' => 'html_ru',
                                'format' => 'raw'
                            ],
                        ],
                    ]) ?>
                </div>
                <div class="col-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title_en',
                            [
                                'attribute' => 'html_en',
                                'format' => 'raw'
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
