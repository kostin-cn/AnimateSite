<?php
use frontend\assets\MapAsset;
/* @var $this yii\web\View */
/* @var $contacts \common\entities\Contacts[] */
MapAsset::register($this);
?>

<div class="contacts-page">
    <div class="wrapper miniWrap">
        <h2 class="title-border white bg-black">
                    <span>
                    <?= Yii::t('app', 'Контакты');?>
                    <span class="crnr-tl"></span>
                    <span class="crnr-tr"></span>
                    <span class="crnr-bl"></span>
                    <span class="crnr-br"></span>
                </span>
        </h2>
        <div class="textContainer between">
            <div class="textBlock">
                <div class="blockTitle"><?= Yii::t('app', 'Мы в соц. сетях');?></div>
                <div class="blockText">
                    <?php foreach ($socials as $social):;?>
                        <a href="<?= $social->link;?>" target="_blank"><?= $social::VARIANTS[$social->icon];?></a>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="textBlock">
                <div class="blockTitle"><?= Yii::t('app', 'Адрес');?></div>
                <div class="blockText">
                    <?php foreach ($addresses as $address):;?>
                        <p><?= $address->value;?></p>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="textBlock">
                <div class="blockTitle"><?= Yii::t('app', 'Телефон');?></div>
                <div class="blockText">
                    <?php foreach ($phones as $phone):;?>
                        <a href="tel:<?= str_replace([' ', '(', ')'], '', $phone->value); ?>"><?= $phone->value;?></a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <div id="coordinates"
             data-lat="55.7843614"
             data-lng="37.5591576"
             data-centerlat="55.7843614"
             data-centerlng="37.5591576"
             data-zoom="17"
             data-title="Madison">
        </div>
        <div id="map"></div>
    </div>
</div>
