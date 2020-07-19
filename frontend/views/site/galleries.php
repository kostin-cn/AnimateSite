<?php
/* @var $this yii\web\View
 * @var $galleries \common\entities\Galleries[]
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="title-block">
    <div class="wrapper miniWrap">
        <div style="overflow: hidden">
            <h1 class="jq_hidden">
                <?php $strArr = preg_split('//u',Yii::t('app', 'Галерея'),-1,PREG_SPLIT_NO_EMPTY);
                foreach ($strArr as $str) {
                    echo Html::tag('span', $str) . '<span class="icon-rhombus-fill"></span>';
                }
                ?>
            </h1>
        </div>
        <div style="overflow: hidden">
            <p class="jq_hidden"><?= Yii::t('app', 'Нажмите на фото и тяните курсор,<br>чтобы листать фото');?></p>
        </div>
    </div>
</div>

<div class="galleriesContainer">
    <?php foreach ($galleries as $cnt=>$gallery):;?>
        <?php if ($gallery->gallery):;?>
            <div class="galleriesBlock jq_hidden">
                <?php $len = count($gallery->galleriesAttachments);?>
                <?php if ($cnt%2) {;?>
                    <div class="gallerySlider gallerySliderSecond">
                        <div class="slide">
                            <div class="slideText">
                                <a href="<?= Url::to(['site/gallery', 'slug' => $gallery->slug]);?>" class="read-more">
                                    <span><?= Yii::t('app', 'Посмотреть все фото');?></span>
                                    <span class="icon-arrow-right"></span>
                                    <span class="icon-rhombus"></span>
                                </a>
                            </div>
                        </div>
                        <?php foreach ($gallery->galleriesAttachments as $key=>$attachment) {;?>
                            <?php if ($key == $len-1) {;?>
                                <div class="slide">
                                    <div class="bg_image" style="background-image: url('<?= $attachment->getUrl();?>')"></div>
                                    <div class="galleryText galTitle">
                                        <h3><?= $gallery->title;?></h3>
                                        <p><?= $gallery->html;?></p>
                                    </div>
                                </div>
                                <?php }else{;?>
                                <div class="slide">
                                    <div class="bg_image" style="background-image: url('<?= $attachment->getUrl();?>')"></div>
                                </div>
                                <?php };?>
                        <?php };?>
                    </div>
                <?php }else {;?>
                    <div class="gallerySlider">
                        <?php foreach ($gallery->galleriesAttachments as $key=>$attachment) {;?>
                            <?php if ($key == 0) {;?>
                                <div class="slide">
                                    <div class="bg_image" style="background-image: url('<?= $attachment->getUrl();?>')"></div>
                                    <div class="galleryText galTitle">
                                        <h3><?= $gallery->title;?></h3>
                                        <p><?= $gallery->html;?></p>
                                    </div>
                                </div>
                            <?php }else{;?>
                                <div class="slide">
                                    <div class="bg_image" style="background-image: url('<?= $attachment->getUrl();?>')"></div>
                                </div>
                            <?php };?>
                        <?php };?>
                        <div class="slide">
                            <div class="slideText">
                                <a href="<?= Url::to(['site/gallery', 'slug' => $gallery->slug]);?>" class="read-more">
                                    <span><?= Yii::t('app', 'Посмотреть все фото');?></span>
                                    <span class="icon-arrow-right"></span>
                                    <span class="icon-rhombus"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php };?>

            </div>
        <?php endif;?>
    <?php endforeach;?>
</div>