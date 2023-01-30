<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Recruits */

$this->title = 'Призовник: ' . $model->last_name . ' ' .$model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recruits-view box box-warning">

    <div class="box-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="box-body">
        <p>
            <?= Html::a('Змінити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Ви впевнені, що хочете видалити призовника?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Назад', ['index'] ,['class' => 'btn btn-warning']) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
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
              [
                'attribute' => 'address_registration',
                'value' => function($data) {
                  return \app\models\AddressesRegistration::getAddressStringForRecruit($data->id);
                },
                'format' => 'html',
              ],
              [
                'attribute' => 'address_actual',
                'value' => function($data) {
                  return \app\models\AddressesActual::getAddressStringForRecruit($data->id);
                },
                'format' => 'html',
              ],
              'date_of_povestka',
              'date_of_getting_povestka',
            ],
        ]) ?>


      <?php if(!empty($model->passport_series) && !empty($model->passport_number)): ?>
        <?php
        $files = '';
        $folder_path = Yii::getAlias('@webroot').'/upload/recruits/' . $model->passport_series . $model->passport_number;
        if(is_dir($folder_path)) {
          $files = \yii\helpers\FileHelper::findFiles(Yii::getAlias('@webroot').'/upload/recruits/' . $model->passport_series . $model->passport_number );

          $files_url = [];
          foreach ($files as $key => $file) {
            $files_url[] = 'https://' . $_SERVER['HTTP_HOST'] . '/' . str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
          }
        }
        ?>

        <?php if(!empty($files_url)):?>
          <h3>Документи</h3>
          <ul class="files">
            <?php foreach ($files_url as $file):?>
            <li><a href="<?php echo $file?>" target="_blank" download><?php echo basename($file)?></a></li>
            <?php endforeach;?>
          </ul>
        <?php endif;?>



      <?php endif;?>
    </div>
</div>
