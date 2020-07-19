<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\MapAsset;
//use frontend\assets\SmoothAsset;
/* @var $this yii\web\View
 * @var $page1 \common\entities\Modules
 * @var $page2 \common\entities\Modules
 * @var $page3 \common\entities\Modules
 * @var $page4 \common\entities\Modules
 * @var $page5 \common\entities\Modules
 * @var $events \common\entities\Events[]
 * @var $addresses \common\entities\Contacts[]
 * @var $phones \common\entities\Contacts[]
 * @var $socials \common\entities\Socials[]
 */
MapAsset::register($this);
//SmoothAsset::register($this);
?>
<div id="indexSlider">

    <div class="slide thisSlide-active">
        <div class="bg-image" style="background-image: url('<?= $page1->image;?>')"></div>
        <div class="slideText center txtCenter">
            <h2><?= $page1->title;?></h2>
            <a class="read-more center" href="<?= Url::to(['site/about']);?>">
                <span><?= Yii::t('app', 'Подробнее');?></span>
                <span class="icon-arrow-right"></span>
                <span class="icon-rhombus"></span>
            </a>
        </div>
        <div class="slideBottom">
            <div class="wrapper">
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
                                <span><?= $address->value;?></span>
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
                    <div class="textBlock">
                        <div class="blockText">
                            <div><span>Made by </span><strong>Creative connection</strong></div>
                        </div>
                    </div>
                    <div class="textBlock copyright">
                        <div class="blockText">
                            <span>&copy; <?= Yii::$app->name; ?>, <?= date('Y'); ?>. <?= Yii::t('app', 'All rights reserved.'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="bg-image" style="background-image: url('<?= $page2->image;?>')"></div>
        <div class="slideText right white">
            <div class="double-border brown bg-white">
                <span class="icon-m"></span>
                <span class="icon-m"></span>
            </div>
            <div class="slideTextWrap">
                <h2 class="title-border brown bg-white">
                <span>
                    <?= $page2->title;?>
                    <span class="crnr-tl"></span>
                    <span class="crnr-tr"></span>
                    <span class="crnr-bl"></span>
                    <span class="crnr-br"></span>
                </span>
                </h2>
                <?= $page2->html;?>
                <a href="<?= Url::to(['site/about']);?>"><?= Yii::t('app', 'Подробнее о проекте');?></a>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="bg-image" style="background-image: url('<?= $page3->image;?>')"></div>
        <div class="slideText left">
            <h2><?= $page3->title;?></h2>
            <div class="read-more slide-next">
                <span><?= Yii::t('app', 'Листать');?></span>
                <span class="icon-arrow-right"></span>
                <span class="icon-rhombus"></span>
            </div>
        </div>
        <div class="slideImg">
            <?php foreach ($page3->modulesAttachments as $attachment){
                echo Html::img($attachment->getUrl());
            };?>
        </div>
    </div>

    <div class="slide">
        <div class="bg-image" style="background-image: url('<?= $page4->image;?>')"></div>
        <div class="slideText left">
            <div class="read-more slide-next">
                <span><?= Yii::t('app', 'Листать');?></span>
                <span class="icon-arrow-right"></span>
                <span class="icon-rhombus"></span>
            </div>
        </div>
        <div class="slideText right dark">
            <div class="double-border brown bg-black">
                <span class="icon-m"></span>
                <span class="icon-m"></span>
            </div>
            <div class="slideTextWrap">
                <h2 class="title-border brown bg-black">
                <span>
                    <?= $page4->title;?>
                    <span class="crnr-tl"></span>
                    <span class="crnr-tr"></span>
                    <span class="crnr-bl"></span>
                    <span class="crnr-br"></span>
                </span>
                </h2>
                <?= $page4->html;?>
                <a href="<?= Url::to(['site/menu']);?>"><?= Yii::t('app', 'Посмотреть меню');?></a>
            </div>
        </div>
        <div class="slideImg">
            <?php foreach ($page4->modulesAttachments as $attachment){
                echo Html::img($attachment->getUrl());
            };?>
        </div>
    </div>

    <div class="slide">
        <div class="bg-image" style="background-image: url('<?= $page5->image;?>')"></div>
        <div class="slideText right white">
            <div class="double-border brown bg-white">
                <span class="icon-m"></span>
                <span class="icon-m"></span>
            </div>
            <div class="slideTextWrap">
                <h2 class="title-border brown bg-white">
                <span>
                    <?= $page5->title;?>
                    <span class="crnr-tl"></span>
                    <span class="crnr-tr"></span>
                    <span class="crnr-bl"></span>
                    <span class="crnr-br"></span>
                </span>
                </h2>
                <?php foreach ($events as $key=>$event):;?>
                    <div class="eventBlock">
                        <?php if ($key!=0){;?>
                            <div class="evnt-divider"></div>
                        <?php };?>
                        <h3><?= $event->title;?></h3>
                        <p><?= Yii::$app->formatter->asDate($event->date, 'dd MMMM yyyy');?></p>
                        <p><?= $event->shortDesc;?></p>
                        <a href="<?= Url::to(['site/article', 'slug' => $event->slug]);?>"><?= Yii::t('app', 'Подробнее');?></a>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="slideText contacts">
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
                                <span><?= $address->value;?></span>
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
        <div class="slideBottom">
            <div class="wrapper miniWrap">
                <div class="textContainer center">
                    <div class="textBlock">
                        <div class="blockText">
                            <p>Made by <strong>Creative connection</strong></p>
                        </div>
                    </div>
                    <div class="textBlock copyright">
                        <div class="blockText">
                            <p>&copy; <?= Yii::$app->name; ?>, <?= date('Y'); ?>. <?= Yii::t('app', 'All rights reserved.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
