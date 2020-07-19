<?php

use common\entities\Contacts;
use common\entities\Modules;
use common\entities\Socials;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$menuImg = Modules::getDb()->cache(function () {
    return Modules::findOne(6);
}, Yii::$app->params['cacheTime']);
$addresses = Contacts::getDb()->cache(function () {
    return Contacts::find()->having(['status' => 1])->andWhere(['type' => 'point'])->orderBy('sort')->all();
}, Yii::$app->params['cacheTime']);
$phones = Contacts::getDb()->cache(function () {
    return Contacts::find()->having(['status' => 1])->andWhere(['type' => 'phone'])->orderBy('sort')->all();
}, Yii::$app->params['cacheTime']);
$socials = Socials::getDb()->cache(function () {
    return Socials::find()->having(['status' => 1])->orderBy('sort')->all();
}, Yii::$app->params['cacheTime']);

$menuItems = [
    ['label' => Yii::t('app', 'Madison'), 'url' => ['site/about']],
    ['label' => Yii::t('app', 'Меню'), 'url' => ['site/menu']],
    ['label' => Yii::t('app', 'Галерея'), 'url' => ['site/galleries']],
    ['label' => Yii::t('app', 'Новости'), 'url' => ['site/news']],
    ['label' => Yii::t('app', 'Контакты'), 'url' => ['site/contacts']],
];

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="main" class="body-<?= Yii::$app->controller->action->id;?>">
    <?= Alert::widget() ?>

    <div id="content" class="contentWrapper">
        <div id="mainNav">
            <?= $this->render('mainNav', [
                'menuItems' => $menuItems,
                'menuImg' => $menuImg,
            ]); ?>
        </div>
        <?= $content ?>

        <div class="b-tt b-left"></div>
        <div class="b-tt b-right"></div>
        <div class="b-bb b-left"></div>
        <div class="b-bb b-right"></div>
        <div class="b-ll"></div>
        <div class="b-rr"></div>
        <div class="b-tl"></div>
        <div class="b-tc"></div>
        <div class="b-tr"></div>
        <div class="b-bl"></div>
        <div class="b-bc"></div>
        <div class="b-br"></div>
        
    </div>

    <?= $this->render('footer', [
        'addresses' => $addresses,
        'phones' => $phones,
        'socials' => $socials,
    ]); ?>
    <div id="pop-up">
        <div id="pop-close" class="close">
            <span></span>
            <span></span>
        </div>
        <div id="pop-content"></div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
