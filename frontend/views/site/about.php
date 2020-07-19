<?php

/* @var $this yii\web\View
 * @var $abouts \common\entities\Abouts[]
 */

use yii\helpers\Html;

?>
<div class="aboutContainer">
    <?php foreach ($abouts as $key => $about):;?>
    <div class="aboutBlock">
        <div class="aboutFirst">
            <div class="bg-image" style="background-image: url('<?= $about->image;?>')"></div>
            <div class="wrapper">
                <div style="overflow: hidden">
                    <h2 class="jq_hidden">
                        <?php $strArr = preg_split('//u',$about->title,-1,PREG_SPLIT_NO_EMPTY);
                        foreach ($strArr as $str) {
                            echo Html::tag('span', $str) . '<span class="icon-rhombus-fill"></span>';
                        }
                        ?>
                    </h2>
                </div>
                <?php if ($key == 0) {;?>
                    <div class="jq_hidden">
                        <a class="read-more scroll-btn" href="#">
                            <span><?= Yii::t('app', 'Листать');?></span>
                            <span class="icon-arrow-right"></span>
                            <span class="icon-rhombus"></span>
                        </a>
                    </div>
                <?php };?>
            </div>
        </div>
        <div class="aboutSecond">
            <div class="aboutText jq_hidden">
                <div class="double-text-border brown">
                    <div class="border-in">
                        <span class="crnr-tl"></span>
                        <span class="crnr-tr"></span>
                        <span class="crnr-bl"></span>
                        <span class="crnr-br"></span>
                    </div>
                    <div class="border-out">
                        <span class="crnr-tl"></span>
                        <span class="crnr-tr"></span>
                        <span class="crnr-bl"></span>
                        <span class="crnr-br"></span>
                    </div>
                </div>
                <h3><?= $about->subTitle;?></h3>
                <?= $about->html;?>
            </div>
            <div class="aboutImg jq_hidden">
                <?php foreach ($about->aboutsAttachments as $attachment) {
                    echo Html::img($attachment->getUrl());
                };?>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>
