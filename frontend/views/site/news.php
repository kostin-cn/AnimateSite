<?php
/* @var $this yii\web\View
 * @var $events \common\entities\Events[]
 * @var $pages array
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="page-title white">
    <div class="wrapper">
        <div class="textWrapper">
            <h1>
                <?php $strArr = preg_split('//u',Yii::t('app', 'Новости'),-1,PREG_SPLIT_NO_EMPTY);
                foreach ($strArr as $str) {
                    echo Html::tag('span', $str) . '<span class="icon-rhombus-fill"></span>';
                }
                ?>
            </h1>
        </div>
    </div>
</div>

<div id="indexNews" class="newsContainer jq_hidden ias-news-block" data-load-more="<?= Yii::t('app', 'Load more');?>">

        <?php foreach ($events as $newsItem) {?>
            <a class="newsItem" href="<?= Url::to(['site/article','slug'=>$newsItem->slug]);?>">
                <img src="<?= $newsItem->image;?>" alt="">
                <div class="newsInfo">
                    <h3 class="newsTile"><?= $newsItem->title;?></h3>
                    <div class="newsDate"><?= Yii::$app->formatter->asDate($newsItem->date, 'dd.MM.yyyy'); ?></div>
                </div>
                <div class="read-more">
                    <span><?= Yii::t('app', 'Подробнее');?></span>
                    <span class="icon-arrow-right"></span>
                    <span class="icon-rhombus"></span>
                </div>
            </a>
        <?php }?>

    <div id="pagination">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
    </div>
</div>
