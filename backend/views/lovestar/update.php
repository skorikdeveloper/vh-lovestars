<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Collaboration */

$this->title = 'Edit Collaboration: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="collaboration-update box box-info">

    <div class="box-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>
    </div>

</div>
