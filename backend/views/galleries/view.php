<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\entities\Galleries */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['index']];
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

            <?php if ($model->gallery) {
                echo '<h2 style="font-size: 2em">Изображения</h2><br>';
                foreach ($model->galleriesAttachments as $attachment) {
                    echo Html::img($attachment->getUrl(), ['style' => 'width:300px;margin:0 10px 10px 0;']);
                }
            }; ?>

        </div>
    </div>
</div>
