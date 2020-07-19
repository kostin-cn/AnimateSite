<?php
namespace frontend\controllers;

use common\entities\Abouts;
use common\entities\Contacts;
use common\entities\Documents;
use common\entities\Events;
use common\entities\Galleries;
use common\entities\Menus;
use common\entities\Modules;
use common\entities\Order;
use common\entities\Socials;
use Yii;
use frontend\components\FrontendController;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class SiteController extends FrontendController
{
    public function actionIndex()
    {
        $this->findSeoAndSetMeta('index');

        $page1 = Modules::findOne(1);
        $page2 = Modules::findOne(2);
        $page3 = Modules::findOne(3);
        $page4 = Modules::findOne(4);
        $page5 = Modules::findOne(5);

        $events = Events::find()->having(['status' => 1])->orderBy(['date' => SORT_DESC])->limit(2)->all();
        $addresses = Contacts::find()->having(['status' => 1])->andWhere(['type' => 'point'])->orderBy('sort')->all();
        $phones = Contacts::find()->having(['status' => 1])->andWhere(['type' => 'phone'])->orderBy('sort')->all();
        $socials = Socials::find()->having(['status' => 1])->orderBy('sort')->all();

        return $this->render('index', [
            'page1' => $page1,
            'page2' => $page2,
            'page3' => $page3,
            'page4' => $page4,
            'page5' => $page5,
            'events' => $events,
            'addresses' => $addresses,
            'phones' => $phones,
            'socials' => $socials,
        ]);
    }

    public function actionAbout()
    {
        $this->findSeoAndSetMeta('about');

        $abouts = Abouts::find()->having(['status' => 1])->orderBy('sort')->all();
        return $this->render('about', [
            'abouts' => $abouts,
        ]);
    }

    public function actionMenu()
    {
        $this->findSeoAndSetMeta('menu');

        $header = Modules::findOne(7);
        $menus = Menus::find()->having(['status' => 1])->orderBy('sort')->all();
        $documents = Documents::find()->having(['status' => 1])->orderBy('sort')->all();
        return $this->render('menu', [
            'header' => $header,
            'menus' => $menus,
            'documents' => $documents,
        ]);
    }

    public function actionGalleries()
    {
        $this->findSeoAndSetMeta('gallery');

        $galleries = Galleries::find()->having(['status' => 1])->orderBy('sort')->all();
        return $this->render('galleries', [
            'galleries' => $galleries,
        ]);
    }

    public function actionGallery($slug)
    {
        if (!$gallery = Galleries::findOne(['slug' => $slug])) {
            throw new NotFoundHttpException('Запрошенная вами страница не существует.');
        }

        $this->findSeoAndSetMeta('gallery');
        $galleries = Galleries::find()->having(['status' => 1])->orderBy('sort')->all();
        return $this->render('gallery', [
            'gallery' => $gallery,
            'galleries' => $galleries,
        ]);
    }

    public function actionNews()
    {
        $this->findSeoAndSetMeta('news');
        $query = Events::find()->having(['status' => 1])->orderBy(['date' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $pages->pageSizeParam = false;
        $events = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('news', [
            'events' => $events,
            'pages' => $pages,
        ]);
    }

    public function actionArticle($slug)
    {
        if (!$article = Events::findOne(['slug' => $slug])) {
            throw new NotFoundHttpException('Запрошенная вами страница не существует.');
        }
        $this->setMeta($article->meta_title ?: $article->title, $article->meta_description, $article->meta_keywords);
        return $this->render('article', [
            'article' => $article,
        ]);
    }

    public function actionContacts()
    {
        $this->findSeoAndSetMeta('contacts');

        $addresses = Contacts::find()->having(['status' => 1])->andWhere(['type' => 'point'])->orderBy('sort')->all();
        $phones = Contacts::find()->having(['status' => 1])->andWhere(['type' => 'phone'])->orderBy('sort')->all();
        $socials = Socials::find()->having(['status' => 1])->orderBy('sort')->all();
        return $this->render('contacts', [
            'addresses' => $addresses,
            'phones' => $phones,
            'socials' => $socials,
        ]);
    }

    public function actionReserve()
    {
        $model = new Order();

        $model->date_form = Yii::$app->formatter->asDatetime('now', 'dd.MM.yyyy');

        if ($model->load(Yii::$app->request->post())) {
            $model->date = strtotime($model->date_form);
            $model->time = $model->time_from . "-" . $model->time_till ?: '??:??';
            $model->language = Yii::$app->language;
            if ($model->save()) {
                $model->sendEmail();
                Yii::$app->session->setFlash('success', Yii::t('app', 'Спасибо за Ваш заказ!'));
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->renderAjax('order_ajax', [
            'model' => $model,
        ]);
    }

    public function actionPolicy()
    {
        $this->findSeoAndSetMeta('policy');

        $text = Modules::findOne(8);
        return $this->render('policy', [
            'text' => $text,
        ]);
    }
}