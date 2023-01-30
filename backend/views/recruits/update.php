<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $addresses_registration app\models\AddressesRegistration */
/* @var $addresses_actual app\models\AddressesActual */
/* @var $upload_files app\models\UploadFiles */

$this->title = 'Змінити призовника: ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recruits-update box box-info">

    <div class="box-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            'addresses_registration' => $addresses_registration,
            'addresses_actual' => $addresses_actual,
//            'upload_files' => $upload_files,
        ]) ?>
    </div>

</div>
