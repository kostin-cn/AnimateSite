<?php

use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;

/* @var $this yii\web\View */
$this->title = 'Файл-менеджер'
?>

<div class="row">
    <div class="col-xs-12">
        <?php echo ElFinder::widget([
            'language'         => 'ru',
            'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'path' => '', // будет открыта папка из настроек контроллера с добавлением указанной под деритории
            'filter'           => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
            'callbackFunction' => new JsExpression('function(file, id){}'), // id - id виджета
            'frameOptions' => ['style'=>'min-height: 600px; width: 100%; border: 0'],
        ]);
        ?>
    </div>
</div>
