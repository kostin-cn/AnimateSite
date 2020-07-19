<?php

use yii\helpers\Url;
use yii\widgets\Menu;
use common\widgets\MultiLang\MultiLang;

/* @var $menuItems array */
/* @var $menuImg \common\entities\Modules */
?>

<div id="menu">
    <div class="wrapper">
        <div class="topMenuBlock left">
            <?= MultiLang::widget(); ?>
            <div id="menuBtn">
                <span class="icon-rhombus"></span>
                <span><?= Yii::t('app', 'Меню');?></span>
                <span><?= Yii::t('app', 'Закрыть');?></span>
            </div>
        </div>
        <div class="topMenuBlock center">
            <a id="logo" href="<?= Url::to(['site/index']); ?>">
                <span class="icon-logo"></span>
            </a>
        </div>
        <div class="topMenuBlock right">
            <a id="reserveBtn" href="<?= Url::to(['site/reserve']);?>">
                <span class="icon-rhombus"></span>
                <span><?= Yii::t('app', 'Резерв');?></span>
            </a>
        </div>
    </div>
</div>

<div class="mainNavMenu">
    <div class="left">
        <div class="image" style="background-image: url('<?= $menuImg->image;?>')"></div>
    </div>
    <div class="right">
        <div class="navMenuText">
            <?= Menu::widget([
                'items' => $menuItems,
                'options' => ['class' => 'navMenu navigation'],
            ]); ?>
            <a class="policy" href="<?= Url::to(['site/policy']);?>"><?= Yii::t('app', 'Политика конфиденциальности');?></a>
        </div>
        <a class="btn-back" href="<?= Url::to(['site/index']);?>">
            <span class="icon-rhombus"></span>
            <span class="icon-arrow-left"></span>
            <span><?= Yii::t('app', 'На главную');?></span>
        </a>
    </div>
</div>

<div id="popUpReserve">
    <div id="reserveClose"></div>
    <div id="reserveContent"></div>
</div>
