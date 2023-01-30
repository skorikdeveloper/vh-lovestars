<?php
$currentUrl = Yii::$app->request->pathInfo;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>
                    <?php if (!Yii::$app->user->isGuest) : ?>
                        <?= Yii::$app->user->identity['full_name']; ?>
                    <?php endif; ?>
                </p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?php

        $menu = [
          'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
          'activateParents'=>true,
          'items' => [
            ['label' => 'Menu LCAPP', 'options' => ['class' => 'header']],
            //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
            ['label' => 'Home', 'icon' => 'home fa-fw', 'url' => ['/']],
          ],
        ];

        if(Yii::$app->user->identity['role'] === 'admin') {
          $menu['items'][] =   [
            'label' => 'Collaboration',
            'icon' => 'sitemap fa-fw',
            'url' => '#',
            'items' => [
              ['label' => 'All Collaborations', 'icon' => 'dashboard fa-fw', 'url' => ['/collaboration/'],
                'active' => strpos($currentUrl, 'collaboration') !== false && strpos($currentUrl, 'collaboration-outcome') === false,],
              ['label' => 'Add New', 'icon' => 'pencil fa-fw', 'url' => ['/collaboration/create'],],
            ],
          ];
	
          $menu['items'][] =   [
            'label' => 'Collaboration Outcome',
            'icon' => 'sitemap fa-fw',
            'url' => '#',
            'items' => [
              ['label' => 'All Outcomes', 'icon' => 'dashboard fa-fw', 'url' => ['/collaboration-outcome/'],
                'active' => strpos($currentUrl, 'collaboration-outcome') !== false,],
              ['label' => 'Add New', 'icon' => 'pencil fa-fw', 'url' => ['/collaboration-outcome/create'],],
            ],
          ];
	
          $menu['items'][] =   [
            'label' => 'Partners',
            'icon' => 'sitemap fa-fw',
            'url' => '#',
            'items' => [
              ['label' => 'All Partner', 'icon' => 'dashboard fa-fw', 'url' => ['/partner/'],
                'active' => strpos($currentUrl, 'partner') !== false && strpos($currentUrl, 'partner-rule') === false && strpos($currentUrl, 'partner-rule-action') === false],
              ['label' => 'Add New', 'icon' => 'pencil fa-fw', 'url' => ['/partner/create'],],
            ],
          ];
	
          $menu['items'][] =   [
            'label' => 'Partner Rule',
            'icon' => 'sitemap fa-fw',
            'url' => '#',
            'items' => [
              ['label' => 'All Rules', 'icon' => 'dashboard fa-fw', 'url' => ['/partner-rule/'],
                'active' => strpos($currentUrl, 'partner-rule') !== false && strpos($currentUrl, 'partner-rule-action') === false],
              ['label' => 'Add New', 'icon' => 'pencil fa-fw', 'url' => ['/partner-rule/create'],],
            ],
          ];
          
          $menu['items'][] =   [
            'label' => 'Partner Rule Action',
            'icon' => 'sitemap fa-fw',
            'url' => '#',
            'items' => [
              ['label' => 'All Actions', 'icon' => 'dashboard fa-fw', 'url' => ['/partner-rule-action/'],
                'active' => strpos($currentUrl, 'partner-rule-action') !== false],
              ['label' => 'Add New', 'icon' => 'pencil fa-fw', 'url' => ['/partner-rule-action/create'],],
            ],
          ];
	
          $menu['items'][] =   [
            'label' => 'HashTags',
            'icon' => 'sitemap fa-fw',
            'url' => '#',
            'items' => [
              ['label' => 'All HashTags', 'icon' => 'dashboard fa-fw', 'url' => ['/hash-tag/'],
                'active' => strpos($currentUrl, 'hash-tag') !== false,],
              ['label' => 'Add New', 'icon' => 'pencil fa-fw', 'url' => ['/hash-tag/create'],],
            ],
          ];
	
          $menu['items'][] =   [
            'label' => 'Lovestar',
            'icon' => 'sitemap fa-fw',
            'url' => '#',
            'items' => [
              ['label' => 'All Lovestars', 'icon' => 'dashboard fa-fw', 'url' => ['/lovestar/'],
                'active' => strpos($currentUrl, 'lovestar') !== false && strpos($currentUrl, 'lovestar-transaction') === false],
            ],
          ];
	
          $menu['items'][] =   [
            'label' => 'Lovestar Transaction',
            'icon' => 'sitemap fa-fw',
            'url' => '#',
            'items' => [
              ['label' => 'All Transactions', 'icon' => 'dashboard fa-fw', 'url' => ['/lovestar-transaction/'],
                'active' => strpos($currentUrl, 'lovestar-transaction') !== false,],
            ],
          ];
            
          $menu['items'][] = [
            'label' => 'Settings',
            'icon' => 'gears fa-fw',
            'url' => '#',
            'items' => [
              [
                'label' => 'Users',
                'icon' => 'child fa-fw',
                'url' => '#',
                'items' => [
                  ['label' => 'All Users', 'icon' => 'group fa-fw', 'url' => ['settings/user'],
                    'active' => strpos($currentUrl, 'settings/user') !== false],
                  [
                    'label' => 'Create New',
                    'icon' => 'pencil fa-fw',
                    'url' => ['settings/user/create'],
                  ],
                ],
              ],
            ],
          ];
        }

        echo dmstr\widgets\Menu::widget($menu) ?>

    </section>

</aside>
