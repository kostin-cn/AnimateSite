<?php

use yii\helpers\Url;

/* @var $user \common\entities\User */

$user = Yii::$app->user->identity;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $user->getAvatar('/files/anonymous.jpg') ?>"
                     class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $user->getPublicIdentity() ?></p>
                <a href="<?php echo Url::to(['/sign-in/profile']) ?>">
                    <i class="fa fa-circle text-success"></i>
                    <?php echo Yii::$app->formatter->asDatetime(time()) ?>
                </a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Редактор', 'options' => ['class' => 'header']],
//                    ['label' => 'Файл-менеджер', 'icon' => 'file-image-o', 'url' => ['/file-manager']],
                    ['label' => 'Резерв', 'icon' => 'calendar', 'active' => ($this->context->id == 'order'), 'url' => ['/order']],
                    [
                        'label' => 'Изображение в меню',
                        'icon' => 'image',
                        'active' => (Yii::$app->controller->id == 'modules' && Yii::$app->controller->actionParams['id'] == 6),
                        'url' => ['/modules/view', 'id' => 6]
                    ],
                    ['label' => 'Главная',
                        'icon' => (
                            Yii::$app->controller->id == 'seo' && in_array(Yii::$app->controller->actionParams['page'], ['index'])
                            or Yii::$app->controller->id == 'modules' && in_array(Yii::$app->controller->actionParams['id'], [1, 2, 3, 4, 5])
                        ) ? 'folder-open' : 'folder', 'url' => '#',
                        'items' => [
                            ['label' => 'SEO',
                                'icon' => 'file-code-o',
                                'active' => (Yii::$app->controller->id == 'seo' && Yii::$app->controller->actionParams['page'] == 'index'),
                                'url' => ['/seo/view', 'page' => 'index']
                            ],
                            [
                                'label' => 'Добро пожаловать',
                                'icon' => 'file-text-o',
                                'active' => (Yii::$app->controller->id == 'modules' && Yii::$app->controller->actionParams['id'] == 1),
                                'url' => ['/modules/view', 'id' => 1]
                            ],
                            [
                                'label' => 'Концепция',
                                'icon' => 'file-text-o',
                                'active' => (Yii::$app->controller->id == 'modules' && Yii::$app->controller->actionParams['id'] == 2),
                                'url' => ['/modules/view', 'id' => 2]
                            ],
                            [
                                'label' => 'Страница 3',
                                'icon' => 'file-text-o',
                                'active' => (Yii::$app->controller->id == 'modules' && Yii::$app->controller->actionParams['id'] == 3),
                                'url' => ['/modules/view', 'id' => 3]
                            ],
                            [
                                'label' => 'Меню',
                                'icon' => 'file-text-o',
                                'active' => (Yii::$app->controller->id == 'modules' && Yii::$app->controller->actionParams['id'] == 4),
                                'url' => ['/modules/view', 'id' => 4]
                            ],
                            [
                                'label' => 'Новости',
                                'icon' => 'file-text-o',
                                'active' => (Yii::$app->controller->id == 'modules' && Yii::$app->controller->actionParams['id'] == 5),
                                'url' => ['/modules/view', 'id' => 5]
                            ],
                        ],
                    ],
                    ['label' => 'О ресторане',
                        'icon' => (
                            Yii::$app->controller->id == 'seo' && in_array(Yii::$app->controller->actionParams['page'], ['about'])
                            or Yii::$app->controller->id == 'abouts'
                        ) ? 'folder-open' : 'folder', 'url' => '#',
                        'items' => [
                            ['label' => 'SEO',
                                'icon' => 'file-code-o',
                                'active' => (Yii::$app->controller->id == 'seo' && Yii::$app->controller->actionParams['page'] == 'about'),
                                'url' => ['/seo/view', 'page' => 'about']
                            ],
                            ['label' => 'О ресторане', 'icon' => 'file-text-o', 'active' => ($this->context->id == 'abouts'), 'url' => ['/abouts']],
                        ],
                    ],
                    ['label' => 'Галерея',
                        'icon' => (
                            Yii::$app->controller->id == 'seo' && in_array(Yii::$app->controller->actionParams['page'], ['gallery'])
                            or Yii::$app->controller->id == 'galleries'
                        ) ? 'folder-open' : 'folder', 'url' => '#',
                        'items' => [
                            ['label' => 'SEO',
                                'icon' => 'file-code-o',
                                'active' => (Yii::$app->controller->id == 'seo' && Yii::$app->controller->actionParams['page'] == 'gallery'),
                                'url' => ['/seo/view', 'page' => 'gallery']
                            ],
                            ['label' => 'Галерея', 'icon' => 'image', 'active' => ($this->context->id == 'galleries'), 'url' => ['/galleries']],
                        ],
                    ],
                    ['label' => 'Новости',
                        'icon' => (
                            Yii::$app->controller->id == 'seo' && in_array(Yii::$app->controller->actionParams['page'], ['news'])
                            or Yii::$app->controller->id == 'events'
                        ) ? 'folder-open' : 'folder', 'url' => '#',
                        'items' => [
                            ['label' => 'SEO',
                                'icon' => 'file-code-o',
                                'active' => (Yii::$app->controller->id == 'seo' && Yii::$app->controller->actionParams['page'] == 'news'),
                                'url' => ['/seo/view', 'page' => 'news']
                            ],
                            ['label' => 'Новости', 'icon' => 'newspaper-o', 'active' => ($this->context->id == 'events'), 'url' => ['/events']],
                        ],
                    ],
                    ['label' => 'Меню',
                        'icon' => (
                            Yii::$app->controller->id == 'seo' && in_array(Yii::$app->controller->actionParams['page'], ['menu'])
                            or Yii::$app->controller->id == 'modules' && in_array(Yii::$app->controller->actionParams['id'], [7])
                            or Yii::$app->controller->id == 'menus'
                            or Yii::$app->controller->id == 'documents'
                        ) ? 'folder-open' : 'folder', 'url' => '#',
                        'items' => [
                            ['label' => 'SEO',
                                'icon' => 'file-code-o',
                                'active' => (Yii::$app->controller->id == 'seo' && Yii::$app->controller->actionParams['page'] == 'menu'),
                                'url' => ['/seo/view', 'page' => 'menu']
                            ],
                            [
                                'label' => 'Текст',
                                'icon' => 'file-text-o',
                                'active' => (Yii::$app->controller->id == 'modules' && Yii::$app->controller->actionParams['id'] == 7),
                                'url' => ['/modules/view', 'id' => 7]
                            ],
                            ['label' => 'Блюда', 'icon' => 'newspaper-o', 'active' => ($this->context->id == 'menus'), 'url' => ['/menus']],
                            ['label' => 'Файлы', 'icon' => 'file-text-o', 'active' => ($this->context->id == 'documents'), 'url' => ['/documents']],
                        ],
                    ],
                    ['label' => 'Контакты',
                        'icon' => (
                            Yii::$app->controller->id == 'seo' && in_array(Yii::$app->controller->actionParams['page'], ['contacts'])
                            or Yii::$app->controller->id == 'contacts'
                        ) ? 'folder-open' : 'folder', 'url' => '#',
                        'items' => [
                            ['label' => 'SEO',
                                'icon' => 'file-code-o',
                                'active' => (Yii::$app->controller->id == 'seo' && Yii::$app->controller->actionParams['page'] == 'contacts'),
                                'url' => ['/seo/view', 'page' => 'contacts']
                            ],
                            ['label' => 'Контакты', 'icon' => 'address-book-o', 'active' => ($this->context->id == 'contacts'), 'url' => ['/contacts']],
                        ],
                    ],
                    [
                        'label' => 'Политика конфиденциальности',
                        'icon' => (
                            Yii::$app->controller->id == 'seo' && in_array(Yii::$app->controller->actionParams['page'], ['policy'])
                            or Yii::$app->controller->id == 'modules' && in_array(Yii::$app->controller->actionParams['id'], [8])
                        ) ? 'folder-open' : 'folder', 'url' => '#',
                        'items' => [
                            ['label' => 'SEO',
                                'icon' => 'file-code-o',
                                'active' => (Yii::$app->controller->id == 'seo' && Yii::$app->controller->actionParams['page'] == 'policy'),
                                'url' => ['/seo/view', 'page' => 'policy']
                            ],
                            [
                                'label' => 'Текст',
                                'icon' => 'file-text-o',
                                'active' => (Yii::$app->controller->id == 'modules' && Yii::$app->controller->actionParams['id'] == 8),
                                'url' => ['/modules/view', 'id' => 8]
                            ],
                        ],
                    ],
                    ['label' => 'Соцсети', 'icon' => 'facebook', 'active' => ($this->context->id == 'socials'), 'url' => ['/socials']],
//                    ['label' => 'Модули', 'icon' => 'file-code-o', 'active' => ($this->context->id == 'modules'), 'url' => ['/modules']],
//                    ['label' => 'SEO', 'icon' => 'file-code-o', 'active' => ($this->context->id == 'seo'), 'url' => ['/seo']],
                ]
            ]
        ) ?>
    </section>
</aside>
