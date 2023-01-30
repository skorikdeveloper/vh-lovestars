<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */
/* @var $addresses_registration app\models\AddressesRegistration */
/* @var $addresses_actual app\models\AddressesActual */
?>

<div class="recruits-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-row">
      <div class="col-md-4">
          <?= $form->field($model, 'passport_series')->textInput(['maxlength' => true, 'style' => 'text-transform:uppercase']) ?>
      </div>

      <div class="col-md-4">
        <?= $form->field($model, 'passport_number')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-4">
        <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-6">
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-6">
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-6">
        <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-6">
        <?= $form->field($model, 'date_of_birth')->widget(\yii\jui\DatePicker::className(),
          [ 'dateFormat' => 'php:d/m//Y',
            'clientOptions' => [
              'changeYear' => true,
              'changeMonth' => true,
              'yearRange' => 'c-70:c+0',
              'altFormat' => 'd/m//Y',
            ]],['placeholder' => 'd/m//Y', 'autocomplete' => 'off'])
          ->textInput(['placeholder' => \Yii::t('app', 'd/m//Y')]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'phone_number')->widget(yii\widgets\MaskedInput::className(), [
          'mask' => '+38(999) 999-9999',
          'options' => [
            'class' => 'form-control placeholder-style',
            'id' => 'phone2',
            'placeholder' => ('Телефон')
          ],
          'clientOptions' => [
            'greedy' => false,
            'clearIncomplete' => true
          ]
        ]) ?>
      </div>

      <div class="col-md-12">
        <?php $ranks = array_replace(['' => 'Вибрати Звання'], array_column(\app\models\Rank::find()->asArray()->all(), 'full_name', 'id')); ?>
        <?= $form->field($model, 'rank')->dropDownList($ranks) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'place_of_work')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'date_of_povestka')->widget(\yii\jui\DatePicker::className(),
          [ 'dateFormat' => 'php:d/m//Y',
            'clientOptions' => [
              'changeYear' => true,
              'changeMonth' => true,
              'yearRange' => 'c-70:c+0',
              'altFormat' => 'd/m//Y',
            ]],['placeholder' => 'd/m//Y', 'autocomplete' => 'off'])
          ->textInput(['placeholder' => \Yii::t('app', 'd/m//Y')]) ?>
      </div>

      <div class="address-registration-wrap address-wrap">
        <div class="col-md-12"><h3>Адреса реєстрації</h3></div>

        <div class="col-md-12">
          <?= $form->field($addresses_registration, 'area')->dropDownList(['' => 'Виберіть область'], ['data-field' => 'area', 'data-current-value' => $addresses_registration->area]) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_registration, 'city')->dropDownList(['' => 'Виберіть місто'], ['data-field' => 'city', 'data-current-value' => $addresses_registration->city]) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_registration, 'district')->textInput(['maxlength' => true, 'data-field' => 'district']) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_registration, 'street')->textInput(['maxlength' => true, 'data-field' => 'street']) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_registration, 'number_of_house')->textInput(['maxlength' => true, 'data-field' => 'number_of_house']) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_registration, 'additional_info')->textInput(['maxlength' => true, 'data-field' => 'additional_info']) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_registration, 'indexes')->textInput(['maxlength' => true, 'data-field' => 'indexes']) ?>
        </div>
      </div>

      <div class="col-md-12" style="margin-top: 30px">
        <?= $form->field($addresses_actual, 'address_same_as_registration')->checkbox(['id' => 'address_same_as_registration']); ?>
      </div>

      <div class="address-actual-wrap address-wrap">
        <div class="col-md-12"><h3 style="margin-top: 0;">Адреса фактична</h3></div>

        <div class="col-md-12">
          <?= $form->field($addresses_actual, 'area')->dropDownList(['' => 'Виберіть область'], ['data-field' => 'area', 'data-current-value' => $addresses_actual->area]) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_actual, 'city')->dropDownList(['' => 'Виберіть місто'], ['data-field' => 'city', 'data-current-value' => $addresses_actual->city]) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_actual, 'district')->textInput(['maxlength' => true, 'data-field' => 'district']) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_actual, 'street')->textInput(['maxlength' => true, 'data-field' => 'street']) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_actual, 'number_of_house')->textInput(['maxlength' => true, 'data-field' => 'number_of_house']) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_actual, 'additional_info')->textInput(['maxlength' => true, 'data-field' => 'additional_info']) ?>
        </div>

        <div class="col-md-12">
          <?= $form->field($addresses_actual, 'indexes')->textInput(['maxlength' => true, 'data-field' => 'indexes']) ?>
        </div>
      </div>

      <div class="col-md-12"><h3>Додаткові дані</h3></div>

      <div class="col-md-12">
        <?php $militarySpecialty = array_replace(['' => 'Вибрати ВОС'], array_column(\app\models\MilitarySpecialty::find()->asArray()->all(), 'full_name', 'id')); ?>
        <?= $form->field($model, 'military_specialty')->dropDownList($militarySpecialty) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'marshr')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'accounting_team')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'alert_result')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'outside_the_district')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'note_on_attendance')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-md-12">
        <?= $form->field($model, 'wanted')->textInput(['maxlength' => true]) ?>
      </div>

      <?php if(!empty($model->passport_series) && !empty($model->passport_number)):?>
      <div class="documents-wrap">
        <div class="col-md-12"><h3>Документи</h3></div>

        <div class="col-md-12">
          <input type="text" id="uploader_files" value="" />
        </div>

      </div>
        <?php
        $files = '';
        $folder_path = Yii::getAlias('@webroot').'/upload/recruits/' . $model->passport_series . $model->passport_number;
        if(is_dir($folder_path)) {
          $files = \yii\helpers\FileHelper::findFiles(Yii::getAlias('@webroot').'/upload/recruits/' . $model->passport_series . $model->passport_number );
          $files_to_obj = [];
          foreach ($files as $key => $file) {
            $files_to_obj[$key]['url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/' . str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
          }
        }
        ?>
      <?php endif;?>

    <?= $form->field($model, 'updated_at')->hiddenInput(['value' => date('d/m//Y H:i:s')])->label(false) ?>
    <?= $form->field($model, 'editor_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

    <div class="form-group" style="text-align: center;">
      <div class="col-md-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'] ,['class' => 'btn btn-danger']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>
  </div>

<?php if(!empty($model->passport_series) && !empty($model->passport_number)): ?>
<script>
//  upload files
$(document).ready(function() {
  let defaultFiles = JSON.parse('<?php echo json_encode($files_to_obj)?>');
  $("#uploader_files").uploader({
    defaultValue: defaultFiles,
    multiple:true,
    ajaxConfig: {
      url: "/admin/upload-files/upload-files",
      method: "post",
      paramsBuilder: function (uploaderFile) {
        let form = new FormData();
        form.append("file", uploaderFile.file)
        form.append("pasport_series", $('#recruits-passport_series').val())
        form.append("pasport_number", $('#recruits-passport_number').val())
        return form
      },
      ajaxRequester: function (config, uploaderFile, progressCallback, successCallback, errorCallback) {
        $.ajax({
          url: config.url,
          contentType: false,
          processData: false,
          method: config.method,
          data: config.paramsBuilder(uploaderFile),
          success: function (response) {
            successCallback(response)
          },
          error: function (response) {
            console.error("Error", response)
            errorCallback("Error")
          },
          xhr: function () {
            let xhr = new XMLHttpRequest();
            xhr.upload.addEventListener('progress', function (e) {
              let progressRate = (e.loaded / e.total) * 100;
              progressCallback(progressRate)
            })
            return xhr;
          }
        })
      },
      responseConverter: function (uploaderFile, response) {
        return {
          url: response.data,
          name: null,
        }
      },
    },
  }).on("file-remove", function(e, removedFile ) {
    // removedFile.url
    //         form.append("pasport_series", $('#recruits-passport_series').val())
    //        form.append("pasport_number", $('#recruits-passport_number').val())
    $.ajax({
      url: '/admin/upload-files/remove-file-by-url',
      method: 'POST',
      data: {url_file_for_remove: removedFile.url, pasport_series: $('#recruits-passport_series').val(), pasport_number: $('#recruits-passport_number').val()},
      success: function (response) {
        console.log(response);
        // successCallback(response)
      },
      error: function (response) {
        console.error("Error", response)
        // errorCallback("Error")
      }
    })

  })
})
</script>
<?php endif;?>
<script>
  $(document).ready(function() {
    const $addressesIsSame = $('#address_same_as_registration');
    const $addressesRegistration = $('.address-registration-wrap');
    const $addressesActual = $('.address-actual-wrap');

    $addressesRegistration.on('change', '[data-field]', () => {
      if($addressesIsSame.is(':checked')) {
        $addressesActual.hide();
        $.each($addressesRegistration.find('[data-field]'), function (index, item){
          $addressesActual.find('[data-field='+$(item).attr('data-field')+']').val($(item).val());
        })
      }
    })

    $addressesIsSame.on('change', addressesIsSame)

    function addressesIsSame() {
      if($addressesIsSame.is(':checked')) {
        $addressesActual.hide();
        $.each($addressesRegistration.find('[data-field]'), function (index, item){
          if($(item).attr('data-field') === 'city') {
            $addressesActual.find('[data-field=city]').html($(item).html())
          }
          $addressesActual.find('[data-field='+$(item).attr('data-field')+']').val($(item).val());

        })
      } else {
        $addressesActual.show();
        // $addressesActual.find('input[data-field]').val('');
      }
    }

    addressesIsSame();

  //  nova poshta api
    const apiKey = 'b4bac950e93fa8b6860b42ddf537dbc7';
    let citiesArr = localStorage.getItem('np_cities') !== null ? JSON.parse(localStorage.getItem('np_cities')) : <?php echo \backend\controllers\AppController::getNovaPoshtaCities()?>.data;
    let areasArr = localStorage.getItem('np_areas') !== null ? JSON.parse(localStorage.getItem('np_areas')) : '';

    if(!areasArr.length) {
      const settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.novaposhta.ua/v2.0/json/",
        "method": "POST",
        "headers": {
          "content-type": "application/json"
        },
        "processData": false,
        "data": "{\r\n\"apiKey\": \""+apiKey+"\",\r\n \"modelName\": \"Address\",\r\n \"calledMethod\": \"getAreas\"}"
      }

      $.ajax(settings).done(function (response) {
        var i = 1;

        areasArr = response.data
        localStorage.setItem('np_areas', JSON.stringify(areasArr))

        $.each($("[data-field=area]"), function (index, item) {
          const $selectArea = $(item);
          $selectArea.append(areasArr.map((area) => '<option data-areas-ref="'+area.Ref+'">'+area.Description+' область</option>').join(''))

          $selectArea.val($selectArea.attr('data-current-value'))
        })
        areas();
      });
    } else {
      $.each($("[data-field=area]"), function (index, item) {
        const $selectArea = $(item);
        $selectArea.append(areasArr.map((area) => '<option data-areas-ref="'+area.Ref+'">'+area.Description+' область</option>').join(''))

        $selectArea.val($selectArea.attr('data-current-value'))
      })
      areas();
    }

    //Подтягиваем г. Украины с API Новая почта при выборе области
    function areas() {
      if($addressesIsSame.is(':checked')) {
        $addressesActual.find('[data-field=area]').val($addressesRegistration.find('[data-field=area]').val())
      }
      if(!citiesArr.length) {
        const settings = {
          "async": true,
          "crossDomain": true,
          "url": "https://api.novaposhta.ua/v2.0/json/",
          "method": "POST",
          "headers": {
            "content-type": "application/json"
          },
          "processData": false,
          "data": "{\r\n\"apiKey\": \""+apiKey+"\",\r\n \"modelName\": \"Address\",\r\n \"calledMethod\": \"getCities\"}"
        }


        $.ajax(settings).done(function (response) {
          var i = 1;
          citiesArr = response.data
          localStorage.setItem('np_cities', JSON.stringify(citiesArr))

          $.each($("[data-field=area]"), function (index, item) {
            const $selectArea = $(item);
            const $selectCity = $(item).closest('.col-md-12').next('.col-md-12').find('[data-field=city]');
            const areasRef = $selectArea.find('option:selected').attr("data-areas-ref");
            const cities = citiesArr.filter(city => city.Area == areasRef);
            $selectCity.append(cities.map((city) => '<option data-city-ref="'+city.Ref+'">'+city.Description+'</option>').join(''))

            $selectCity.val($selectCity.attr('data-current-value'))

            $(item).closest('.address-wrap').find('[data-field=street]').attr('data-city-ref', $selectCity.find('option:selected').attr("data-city-ref"))
            alert(666)
          })

        });
      } else {
        $.each($("[data-field=area]"), function (index, item) {
          const $selectArea = $(item);
          const $selectCity = $(item).closest('.col-md-12').next('.col-md-12').find('[data-field=city]');
          const areasRef = $selectArea.find('option:selected').attr("data-areas-ref");
          const cities = citiesArr.filter(city => city.Area == areasRef);

          $selectCity.html('<option class="first-option">Виберіть місто</option>')
          $selectCity.append(cities.map((city) => '<option data-city-ref="'+city.Ref+'">'+city.Description+'</option>').join(''))

          $selectCity.val($selectCity.attr('data-current-value'))

          $(item).closest('.address-wrap').find('[data-field=street]').attr('data-city-ref', $selectCity.find('option:selected').attr("data-city-ref"))
        })

      }
    }

    $("[data-field=area]").on('change', areas);
    $("[data-field=city]").on('change', function () {
      $(this).attr('data-current-value', $(this).find('option:selected').text())
      $(this).closest('.address-wrap').find('[data-field=street]').attr('data-city-ref', $(this).find('option:selected').attr("data-city-ref"))
    });

    $.each($('[data-field=street]'), function (index, item) {
      $(item).autocomplete({
        source: function( request, response ) {
          const cityRef = $(this.element).attr('data-city-ref')
          const searchString = request.term
          const settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://api.novaposhta.ua/v2.0/json/",
            "method": "POST",
            "headers": {
              "content-type": "application/json"
            },
            "processData": false,
            "data": "{\r\n\"apiKey\": \""+apiKey+"\",\r\n \"modelName\": \"Address\", \r\n \"calledMethod\": \"getStreet\", \r\n \"methodProperties\": {\"CityRef\": \""+cityRef+"\", \"FindByString\": \""+searchString+"\"}}"
          }

          $.ajax(settings).done(function (data) {
            response( data.data );
          });

        },
        minLength: 1,
        select: function( event, ui ) {
          $(this).val(ui.item.StreetsType + " " + ui.item.Description)
          return false;
        }
      }).data("ui-autocomplete")._renderItem = function(ul, item) {
        console.log(item);
        return $( "<li style='padding: 5px 10px'>" )
          .append(item.StreetsType + " " + item.Description)
          .appendTo(ul);
      };
    })

  });
</script>
