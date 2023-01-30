<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\User;
use app\models\Collaboration;

/* @var $this yii\web\View */
/* @var $model app\models\LovestarTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lovestar-transaction-form">
    <?php $form = ActiveForm::begin(); ?>

  <div class="form-row">
    <div class="col-md-5">
      <?php echo $form->field($model, 'userGivingLovestars')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->all(),'id','full_name'),
        'options' => [
          'placeholder' => 'Select Previous Owner',
        ],
      ]); ?>
    </div>

    <div class="col-md-5">
      <?php echo $form->field($model, 'collaborationGivingValue')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Collaboration::find()->all(),'id','title'),
        'options' => [
          'placeholder' => 'Select Collaboration Good',
        ],
      ]); ?>
    </div>

    <div class="col-md-2">
		  <?= $form->field($model, 'lovestars')->textInput(['maxlength' => true])->label('Number of Lovestars') ?>
    </div>

    <div class="form-group" style="text-align: center;">
      <div class="col-md-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'] ,['class' => 'btn btn-danger']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>