<?php
/* @var $this yii\web\View
 * @var $article \common\entities\Events
 */

use yii\helpers\Url;
?>

<div class="article-page">
    <div class="wrapper miniWrap">
        <div class="jq_hidden">
            <img src="<?= $article->image;?>" alt="">
        </div>
        <div class="jq_hidden">
            <h1><?= $article->title;?></h1>
        </div>
        <div class="jq_hidden">
            <p class="newsDate"><?= Yii::$app->formatter->asDate($article->date, 'dd.MM.yyyy'); ?></p>
        </div>
        <div class="jq_hidden">
            <?= $article->html;?>
        </div>
        <div class="jq_hidden">
            <p>
                <a href="<?= Url::to(['site/news']);?>" class="btn-back">
                    <span class="icon-rhombus"></span>
                    <span class="icon-arrow-left"></span>
                    <span><?= Yii::t('app', 'Назад');?></span>
                </a>
            </p>
        </div>
    </div>
</div>
