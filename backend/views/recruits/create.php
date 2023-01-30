<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $addresses_registration app\models\AddressesRegistration */
/* @var $addresses_actual app\models\AddressesActual */

$this->title = 'Додавання нового призовника';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recruits-create box box-success">

    <div class="box-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="box-body">
        <?= $this->render('_form', [
          'model' => $model,
          'addresses_registration' => $addresses_registration,
          'addresses_actual' => $addresses_actual,
        ]) ?>
    </div>

</div>
