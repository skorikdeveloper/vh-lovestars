<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CollaborationOutcome */

$this->title = 'New Collaboration Outcome';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collaboration-outcome-create box box-success">

    <div class="box-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="box-body">
        <?= $this->render('_form', [
          'model' => $model
        ]) ?>
    </div>

</div>
