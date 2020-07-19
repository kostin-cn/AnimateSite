<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\entities\Order;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $restaurant \common\entities\Contacts */

$this->title = 'Резерв';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'name',
                        'filter' => true,
                    ],
                    'email:email',
                    'phone',
                    [
                        'attribute' => 'date',
                        'format' => 'raw',
                        'value' => function (Order $data) {
                            return Yii::$app->formatter->asDate($data->date, 'dd.MM.yyyy');
                        },
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date',
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'todayHighlight' => true,
                                'todayBtn' => true,
                                'autoclose' => true,
                                'format' => 'dd.mm.yyyy',
                            ]
                        ]),
                        'options' => ['width' => '200'],
                    ],
                    'time',
                    'qty',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function (Order $data) {
                            if ($data->status) {
                                if ($data->status ==1) {
                                    return Html::a('<span class="glyphicon glyphicon-ok"></span> Подтвержден', ['status', 'id' => $data->id], ['class' => 'btn btn-success btn-raised']);
                                }else {
                                    return Html::a('<span class="glyphicon glyphicon-ok"></span> Отменен', ['status', 'id' => $data->id], ['class' => 'btn btn-primary btn-raised']);
                                }
                            } else {
                                return Html::a('<span class="glyphicon glyphicon-remove"></span> Ожидает', ['status', 'id' => $data->id], ['class' => 'btn btn-danger btn-raised']);
                            }
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'status',
                            ['0' => 'Ожидает', '1' => 'Подтвержден'],
                            ['class' => 'form-control', 'prompt' => 'Все']
                        ),
                        'options' => ['style' => 'width: 100px; max-width: 100px;'],
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
