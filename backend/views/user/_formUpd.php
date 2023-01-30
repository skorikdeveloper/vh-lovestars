<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use \app\models\Collaboration;
use \app\models\Partner;

$items = [
    ''  => '',
    0 => 'Blocked',
    10 => 'Active'
];

$role = [
    ''  => '',
    'admin' => 'Administrator',
    'user' => 'User',
];

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      
        <div class="col-md-4">
          <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
          <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
        </div>
      
        <div class="col-md-4">
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
          <?= $form->field($model, 'verifiedUser')->dropDownList([
            0 => 'False',
            1 => 'True'
          ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList($items) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'role')->dropDownList($role) ?>
        </div>
    </div>
  
    <div class="row">
      <div class="col-md-4">
		    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
      </div>
      
      <div class="col-md-4">
        <?php echo $form->field($model, 'collaboration')->widget(Select2::classname(), [
          'data' => ArrayHelper::map(Collaboration::find()->all(),'id','title'),
          'options' => [
            'placeholder' => 'Select Collaboration',
    //              'multiple' => true,
          ],
        ]); ?>
      </div>
  
      <div class="col-md-4">
      <?php echo $form->field($model, 'partners')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Partner::find()->all(),'id','legalName'),
        'options' => [
          'placeholder' => 'Select Partners',
          'multiple' => true,
        ],
      ]); ?>
      </div>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['settings/user/view/'.$model->id], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
