<?php
/**
 * Created by PhpStorm.
 * User: Hexagen
 * Date: 02.07.2017
 * Time: 15:24
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyDVfJAnE_5h5-I10ARZhA3DAJ1_ELJ7JKA',
        'js/map.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}