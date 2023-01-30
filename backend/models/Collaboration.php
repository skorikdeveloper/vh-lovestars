<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "Collaboration".
 *
 * @property string $id
 * @property string $publicAlias
 * @property string $title
 * @property string $description
 * @property string $hashtags
 */
class Collaboration extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Collaboration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['title'], 'required'],
          [['description'], 'string'],
          [['hashtags', 'publicAlias'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'hashtags' => 'Hashtags',
            'publicAlias' => 'Public alias',
        ];
    }
	
	static function filterCollaboration($params = []){
		$query = Collaboration::find()->where(['not', ['id' => 0]]);
		$params = !empty($params) ? $params : Yii::$app->request->get();
		$allCollaborations = array_column(Collaboration::find()->all(), 'hashtags', 'id');
		
		foreach ($params as $param => $value){
			if(empty($value) || $param === 'sort' || $param === 'page') continue;
			
			switch ($param) {
				case 'hashtags':
					$ids_with_hashtags = [];
					
					foreach ($allCollaborations as $id => $hashtags) {
						if(!empty(array_intersect($value, explode(',', $hashtags)))) $ids_with_hashtags[] = $id;
					}
					
					$query = $query->andWhere(['in', 'id', $ids_with_hashtags]);
					break;
				case 'title':
					$query = $query->andWhere(['like', $param, '%' . $value . '%', false]);
					break;
				default:
					$query = $query->andWhere([$param => $value]);
					break;
			}
		}
		
		return $query;
	}
}
