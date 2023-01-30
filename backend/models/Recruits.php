<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "categories".
 *
 * @property string $id
 * @property string $passport_series
 * @property string $passport_number
 * @property string $inn
 * @property string $military_specialty
 * @property string $rank
 * @property string $first_name
 * @property string $last_name
 * @property string $father_name
 * @property string $date_of_birth
 * @property string $phone_number
 * @property string $place_of_work
 * @property string $marshr
 * @property string $accounting_team
 * @property string $date_of_povestka
 * @property string $date_of_getting_povestka
 * @property string $alert_result
 * @property string $code
 * @property string $who_carried
 * @property string $outside_the_district
 * @property string $note
 * @property string $note_on_attendance
 * @property string $wanted
 * @property string $updated_at
 * @property string $editor_id
 */
class Recruits extends ActiveRecord
{
  public $address_registration;
  public $address_actual;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recruits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [
            [
              'passport_series',
              'passport_number',
              'rank',
              'last_name',
              'first_name',
              'father_name',
              'date_of_birth',
              'phone_number',
              'place_of_work',
              'date_of_povestka',
              'date_of_getting_povestka',
              'who_carried',
              'updated_at',
            ],
            'required'
          ],
          [
            [
              'inn',
              'military_specialty',
              'marshr',
              'accounting_team',
              'alert_result',
              'code',
              'outside_the_district',
              'note',
              'note_on_attendance',
              'wanted',
              'phone_number',
            ],
            'string'
          ],
          [
            [
              'editor_id'
            ],
            'integer'
          ],
          [
            [
              'address_registration',
              'address_actual'
            ],
            'safe'
          ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID призовника',
            'passport_series' => 'Серія паспорта',
            'passport_number' => '№ паспорта',
            'inn' => 'ІНН',
            'military_specialty' => 'ВОС',
            'rank' => 'Звання',
            'last_name' => 'Прізвище',
            'first_name' => 'Ім\'я',
            'father_name' => 'По батькові',
            'date_of_birth' => 'Дата народження',
            'phone_number' => 'Мобільний телефон',
            'place_of_work' => 'Місце роботи',
            'marshr' => 'Маршр',
            'accounting_team' => 'Облік/команда',
            'date_of_povestka' => 'Дата повістки',
            'date_of_getting_povestka' => 'Дата вручення повістки',
            'alert_result' => 'Прим.(результат оповіщення)',
            'code' => 'Код',
            'who_carried' => 'Хто розносив',
            'outside_the_district' => 'За межами р-ну',
            'note' => 'Примітка',
            'note_on_attendance' => 'Відмітка про явку',
            'wanted' => 'У розшуку',
            'address_registration' => 'Адреса реєстрації',
            'address_actual' => 'Адреса фактична',
            'updated_at' => 'Дата зміни',
            'editor_id' => 'Хто вніс останні зміни',
        ];
    }

    static function filterRecruits(){
      $query = Recruits::find()->where(['not', ['id' => 0]]);

      foreach (Yii::$app->request->get() as $param => $value){
        if(empty($value) || $param === 'sort' || $param === 'page') continue;

        switch ($param) {
          default:
            $query = $query->andWhere([$param => $value]);
            break;
        }
      }

      return $query;
    }
}
