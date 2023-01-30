<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "LovestarTransaction".
 *
 * @property string $id
 * @property string $timestamp
 * @property string $userGivingLovestars
 * @property string $collaborationGivingValue
 * @property string $lovestars
 */
class LovestarTransaction extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'LovestarTransaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['timestamp', 'userGivingLovestars', 'collaborationGivingValue', 'lovestars'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Date',
            'userGivingLovestars' => 'Buyer',
            'collaborationGivingValue' => 'Collaboration Good',
            'lovestars' => 'Lovestars',
        ];
	}
	
	static function filterLovestarTransaction($params = []){
		$query = LovestarTransaction::find()->where(['not', ['id' => 0]]);
		$params = !empty($params) ? $params : Yii::$app->request->get();
		
		foreach ($params as $param => $value){
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
