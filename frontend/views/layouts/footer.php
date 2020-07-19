<?php

/* @var $socials \common\entities\Socials[]
 * @var $addresses \common\entities\Contacts[]
 * @var $phones \common\entities\Contacts[]
 */
?>

<div id="footer">
    <div class="wrapper">
        <div class="footerContainer top">
            <div class="footerBlock">
                <span class="icon-group footLogo"></span>
            </div>
            <div class="footerBlock">
                <span class="icon-gag footLogo"></span>
            </div>
            <div class="footerBlock">
                <div class="blockTitle"><?= Yii::t('app', 'Мы в соц. сетях');?></div>
                <div class="blockText">
                    <?php foreach ($socials as $social):;?>
                        <a href="<?= $social->link;?>" target="_blank"><?= $social::VARIANTS[$social->icon];?></a>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="footerBlock">
                <div class="blockTitle"><?= Yii::t('app', 'Адрес');?></div>
                <div class="blockText">
                    <?php foreach ($addresses as $address):;?>
                        <span><?= $address->value;?></span>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="footerBlock">
                <div class="blockTitle"><?= Yii::t('app', 'Телефон');?></div>
                <div class="blockText">
                    <?php foreach ($phones as $phone):;?>
                        <a href="tel:<?= str_replace([' ', '(', ')'], '', $phone->value); ?>"><?= $phone->value;?></a>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="footerBlock">
                <div class="blockTitle"><?= Yii::t('app', 'Наверх');?></div>
                <div class="blockText" style="align-items: center">
                    <a href="#" class="scroll-up">
                        <span class="icon-arrow-up"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="footerContainer bottom">
            <div class="footerBlock">
                <div class="blockText">
                    <div>
                        <span>Made by </span><strong>Creative connection</strong>
                    </div>
                </div>
            </div>
            <div class="footerBlock">
                <div class="blockText">
                    <span>&copy; <?= Yii::$app->name; ?>, <?= date('Y'); ?>. <?= Yii::t('app', 'All rights reserved.'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
