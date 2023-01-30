<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "CollaborationOutcome".
 *
 * @property string $id
 * @property integer $collaborationId
 * @property string $type
 * @property string $title
 * @property string $description
 * @property string $hashtags
 * @property integer $valueInLovestarsFrom
 * @property integer $valueInLovestarsTo
 */
class CollaborationOutcome extends ActiveRecord
{
	
	static $types = ['1' => 'Tangible', '2' => 'Intangible'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CollaborationOutcome';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['collaborationId', 'type', 'title', 'valueInLovestarsFrom', 'valueInLovestarsTo'], 'required'],
          [['description'], 'string'],
          [['hashtags'], 'safe'],
          [['valueInLovestarsFrom', 'valueInLovestarsTo'], 'integer', 'min' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'collaborationId' => 'Collaboration',
            'type' => 'Type',
            'title' => 'Title',
            'description' => 'Description',
            'hashtags' => 'Hashtags',
            'valueInLovestarsFrom' => 'Value in Lovestars From',
            'valueInLovestarsTo' => 'Value in Lovestars To',
        ];
    }
	
	static function filterCollaborationOutcome($params = []){
		$query = CollaborationOutcome::find()->where(['not', ['id' => 0]]);
		$params = !empty($params) ? $params : Yii::$app->request->get();
		
		$allOutcomes = array_column(CollaborationOutcome::find()->all(), 'hashtags', 'id');
		
		foreach ($params as $param => $value){
			if(empty($value) || $param === 'sort' || $param === 'page') continue;
			
			switch ($param) {
				case 'hashtags':
					$ids_with_hashtags = [];
					
					foreach ($allOutcomes as $id => $hashtags) {
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
