<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "User2Collaboration".
 *
 * @property string $id
 * @property string $userId
 * @property string $collaborationId
 */
class User2Collaboration extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User2Collaboration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['userId', 'collaborationId'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
	
	static function getCollaborationByUserId($userId) {
		return Collaboration::find()->where(['id' => User2Collaboration::find()->where(['userId' => $userId])->one()->collaborationId])->one();
	}
}
