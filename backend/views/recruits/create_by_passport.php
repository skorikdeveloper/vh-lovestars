<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Знайти за паспортом';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recruits-by-passport box box-success">

  <div class="box-header">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>

  <div class="box-body">
    <?php $form = ActiveForm::begin(); ?>

    <div class="form-row">
      <div class="col-md-6">
        <?= $form->field($model, 'passport_series')->textInput(['maxlength' => true, 'style' => 'text-transform:uppercase']) ?>
      </div>

      <div class="col-md-6">
        <?= $form->field($model, 'passport_number')->textInput(['maxlength' => true]) ?>
      </div>
    </div>

    <div class="form-group" style="text-align: center;">
      <div class="col-md-12">
        <?= Html::submitButton('Далі', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['/'] ,['class' => 'btn btn-danger']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>
  </div>

</div>
