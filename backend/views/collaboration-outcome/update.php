<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CollaborationOutcome */

$this->title = 'Edit Collaboration Outcome: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="collaboration-outcome-update box box-info">

    <div class="box-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>
    </div>

</div>
