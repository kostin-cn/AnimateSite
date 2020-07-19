<?php
/* @var $this yii\web\View
 * @var $header \common\entities\Modules
 * @var $menus \common\entities\Menus[]
 * @var $documents \common\entities\Documents[]
 */

use yii\helpers\Html;

?>

<div class="page-title dark">
    <div class="wrapper">
        <div class="textWrapper">
            <div style="overflow: hidden">
                <h1 class="jq_hidden">
                    <?php $strArr = preg_split('//u',$header->title,-1,PREG_SPLIT_NO_EMPTY);
                    foreach ($strArr as $str) {
                        echo Html::tag('span', $str) . '<span class="icon-rhombus-fill"></span>';
                    }
                    ?>
                </h1>
            </div>
            <div style="overflow: hidden">
                <div class="jq_hidden">
                    <?= $header->html;?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="menuContainer">
    <div class="leftMenu">
        <span class="icon-rhombus-90deg"></span>
        <?php foreach ($documents as $document):;?>
            <a href="<?= $document->file;?>" target="_blank"><?= $document->title;?></a>
        <?php endforeach;?>
        <span class="icon-rhombus-90deg"></span>
    </div>
    <?php foreach ($menus as $menu):;?>
    <div class="menuBlock jq_hidden">
        <img src="<?= $menu->image;?>" alt="">
        <p><?= $menu->title;?></p>
    </div>
    <?php endforeach;?>
</div>