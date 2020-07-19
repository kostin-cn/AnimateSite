<?php
/* @var $this yii\web\View
 * @var $galleries \common\entities\Galleries[]
 * @var $gallery \common\entities\Galleries
 */

use yii\helpers\Url;
//use frontend\assets\SmoothAsset;
//SmoothAsset::register($this);
?>

<div class="gallery-page">
    <div class="galleryText">
        <span><?= Yii::t('app', 'Галерея');?></span>
        <div class="galleryTextBlock">
            <?php foreach ($galleries as $cat):;?>
            <?php if ($cat->slug == $gallery->slug){;?>
                    <span style="order: -1"><?= $cat->title;?></span>
            <?php }else {;?>
                    <a href="<?= Url::to(['site/gallery', 'slug' => $cat->slug]);?>"><?= $cat->title;?></a>
            <?php };?>
            <?php endforeach;?>
        </div>
    </div>
    <div id="gallerySlider">
        <?php foreach ($gallery->galleriesAttachments as $attachment):;?>
            <div class="slide">
                <div class="imgWrap">
                    <img src="<?= $attachment->getUrl();?>" alt="">
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <div class="galleryBottomText">
        <a href="<?= Url::to(['site/galleries']);?>" class="btn-back">
            <span class="icon-rhombus"></span>
            <span class="icon-arrow-left"></span>
            <span><?= Yii::t('app', 'Назад');?></span>
        </a>
    </div>
</div>