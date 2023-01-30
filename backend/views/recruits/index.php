<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recruits-index box">

    <div class="box-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="box-body">
        <p>
            <?= Html::a('Додати нового призовника', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


      <div class="search-form" style="float: none;width: 100%;margin: 20px 0;">
        <form method="get" action="<?= \yii\helpers\Url::to(['recruits/index']) ?>">
            <div class="row">
              <div class="col-md-2">
                <label for="rank">Звання</label>
                <select class="form-control" name="rank" id="rank">
                  <option value="" <?php echo empty(Yii::$app->request->get('rank')) ? 'selected' : ''?>>Усi</option>
                  <?php foreach (\app\models\Rank::find()->all() as $rank):?>
                    <option
                        value="<?php echo $rank->id?>"
                      <?php if(!empty(Yii::$app->request->get('rank')) && (int)Yii::$app->request->get('rank') === $rank->id) echo ' selected'?>
                    >
                      <?php echo $rank->full_name?>
                    </option>
                  <?php endforeach;?>
                </select>
              </div>

              <div class="col-md-2">
                <label for="phone_number">Номер Телефону</label>
                <?php echo yii\widgets\MaskedInput::widget([
                  'name' => 'phone_number',
                  'value' => !empty(Yii::$app->request->get('phone_number')) ? Yii::$app->request->get('phone_number'): '',
                  'mask' => '+38(999) 999-9999',
                  'options' => [
                    'class' => 'form-control placeholder-style',
                    'id' => 'phone_number',
                    'placeholder' => ('Телефон')
                  ],
                  'clientOptions' => [
                    'greedy' => false,
                    'clearIncomplete' => true
                  ]
                ])?>
              </div>

              <div class="col-md-2">
                <label for="who_carried">Хто розносив</label>
                <select class="form-control" name="who_carried" id="who_carried">
                  <option value="" <?php echo empty(Yii::$app->request->get('who_carried')) ? 'selected' : ''?>>Усi</option>
                  <?php foreach (\common\models\User::find()->all() as $user):?>
                    <option
                        value="<?php echo $user->id?>"
                      <?php if(!empty(Yii::$app->request->get('who_carried')) && (int) Yii::$app->request->get('who_carried') === $user->id) echo ' selected'?>
                    >
                      <?php echo $user->full_name?>
                    </option>
                  <?php endforeach;?>
                </select>
              </div>
              <!--            <div class="col-md-3">-->
              <!--              <label for="full_name">Название товара</label>-->
              <!--              --><?php
              //              echo \yii\jui\AutoComplete::widget([
              //                'id' => 'full_name',
              //                'name' => 'full_name',
              //                'value' => trim(Yii::$app->request->get('full_name')),
              //                'clientOptions' => [
              //                  'source' => $products_name,
              //                  'minLength' => 3,
              //                ],
              //              ]);
              //              ?>
              <!--              </input>-->
              <!--            </div>-->


              <!--            <div class="col-md-3">-->
              <!--              <label for="category_name">Название категории</label>-->
              <?php
              //              echo \yii\jui\AutoComplete::widget([
              //                'id' => 'category_name',
              //                'name' => 'category_name',
              //                'value' => trim(Yii::$app->request->get('category_name')),
              //                'clientOptions' => [
              //                  'source' => $category_name,
              //                  'minLength' => 3,
              //                ],
              //              ]);
              ?>
              <!--              </input>-->
              <!--            </div>-->

              <!--            <div class="col-md-2">-->
              <!--              <label for="is_stock">В наличии</label>-->
              <!--              <select name="is_stock" id="is_stock" class="form-control">-->
              <!--                <option value="0" -->
              <?php // echo Yii::$app->request->get('is_stock') == 0 ? 'selected' : '';?>
              <!--                >Все</option>-->
              <!--                <option value="1" -->
              <?php // echo Yii::$app->request->get('is_stock') == 1 ? 'selected' : '';?>
              <!--                >Нет</option>-->
              <!--                <option value="2" -->
              <?php // echo Yii::$app->request->get('is_stock') == 2 ? 'selected' : '';?>
              <!--                >Да</option>-->
              <!--              </select>-->
              <!--            </div>-->

              <!--            <div class="col-md-2">-->
              <!--              <label for="condition">Состояние</label>-->
              <!--              <select class="form-control" name="condition" id="condition">-->
              <!--                <option value="0" selected>Все</option>-->
              <!--                <option value="1" -->
              <?php //if(1 == Yii::$app->request->get('condition')) echo ' selected'?>
              <!--                >Несопоставлен</option>-->
              <!--              </select>-->
              <!--            </div>-->

              <!--            <div class="col-md-2">-->
              <!--              <label for="status_id">Статус продукта</label>-->
              <!--              <select class="form-control" name="status_id" id="status_id">-->
              <!--                <option></option>-->
              <!--                --><?php //= \app\components\MenuWidget::widget(['tpl' => 'select_product_status']) ?>
              <!--              </select>-->
              <!--            </div>-->

            </div>

            <div class="row">
              <div class="col-md-offset-4 col-md-4 text-center" style="text-align: center">
                <button type="submit">Знайти</button>
              </div>
            </div>


        </form>
      </div>


        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                  'id',
                  'passport_series',
                  'passport_number',
                  'inn',
                  [
                    'attribute' => 'rank',
                    'value' => function($data) {
                      return !$data->rank ? '<span class="not-set">(not set)</span>' : \app\models\Rank::findOne($data->rank)->full_name;
                    },
                    'format' => 'html',
                  ],
                  [
                    'attribute' => 'military_specialty',
                    'value' => function($data) {
                      return !$data->military_specialty ? '<span class="not-set">(not set)</span>' : \app\models\MilitarySpecialty::findOne($data->military_specialty)->full_name;
                    },
                    'format' => 'html',
                  ],
                  'last_name',
                  'first_name',
                  'father_name',
                  'date_of_birth',
                  'phone_number',
                  'place_of_work',
                  'marshr',
                  'accounting_team',
                  'alert_result',
                  'code',
                  'outside_the_district',
                  'note',
                  'note_on_attendance',
                  'wanted',
                  [
                    'attribute' => 'editor_id',
                    'value' => function($data) {
                      return !$data->editor_id ? '<span class="not-set">(not set)</span>' : Html::a(\common\models\User::findOne($data->editor_id)->full_name, ['settings/user/view/' . $data->editor_id]);
                    },
                    'format' => 'html',
                  ],
                  'updated_at',
                  [
                    'attribute' => 'who_carried',
                    'value' => function($data) {
                      return !$data->who_carried ? '<span class="not-set">(not set)</span>' : Html::a(\common\models\User::findOne($data->who_carried)->full_name, ['settings/user/view/' . $data->who_carried]);
                    },
                    'format' => 'html',
                  ],
                  'date_of_povestka',
                  'date_of_getting_povestka',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '<div class="icon-action-wrapper">{view}</div><div class="icon-action-wrapper">{update}</div><div class="icon-action-wrapper">{delete}</div>',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
