<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\HashTag;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collaboration-index box">

    <div class="box-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="box-body">
        <p>
          <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
      
        <div class="search-form" style="float: none;width: 100%;margin: 20px 0;">
          <form method="get" action="<?= \yii\helpers\Url::to(['collaboration/index']) ?>">
            <div class="row">
              <div class="col-md-2">
                <label for="rank">Title</label>
                <?= Html::input(
                  'text',
                  'title',
                  !empty(Yii::$app->request->get('title')) ? Yii::$app->request->get('title') : '',
                  ['class' => 'form-control']
                ) ?>
              </div>

              <div class="col-md-2">
                <label for="rank">Hashtags</label>
                <?php
                  echo Select2::widget([
                    'value' => Yii::$app->request->get('hashtags'),
                    'name' => 'hashtags',
                    'data' => ArrayHelper::map(HashTag::find()->all(),'id','name'),
                    'options' => ['placeholder' => 'Select Hashtags'],
                    'pluginOptions' => [
                      'allowClear' => true,
                      'multiple' => true
                    ],
                  ]);
                ?>
              </div>
  
              <div class="col-md-2">
                <button type="submit">Search</button>
              </div>
            </div>
          </form>
        </div>

        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  'title',
                  [
                    'attribute' => 'hashtags',
                    'value' => function($data) {
                      return empty($data->hashtags) ? '<span class="not-set">(not set)</span>' : HashTag::fromIdsToNames($data->hashtags);
                    },
                    'format' => 'html',
                  ],
                  [
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '<div class="icon-action-wrapper">{view}</div><div class="icon-action-wrapper">{update}</div><div class="icon-action-wrapper">{delete}</div>',
                  ],
                ],
            ]); ?>
        </div>
    </div>
</div>
