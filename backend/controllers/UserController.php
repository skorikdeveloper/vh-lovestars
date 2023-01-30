<?php

namespace backend\controllers;

use app\models\User2Collaboration;
use app\models\User2Partner;
use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN],
                    ],
                    [
                        'allow' => false,
                        'roles' => [User::ROLE_USER],
                        'denyCallback' => function($rule, $admin) {
                            return $this->redirect(Url::to(['site/no-access']));
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
		$query = User::find();
		if(!empty(Yii::$app->request->get())) $query = User::filterUsers();
		
        $this->setMeta('Users');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
                'pageSizeParam' => false,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->setMeta( $this->findModel($id)->username);
        $pass = $this->findModel($id)->password_hash;
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            if(User::find()->where(['username' => $model->username])->exists()) {
                Yii::$app->session->setFlash('warning', "User with username {$model->username} exists! Choose a different username for the user.");

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
			
			$model->verifiedUser = 1;
			
			if($model->save()) {
				if(!empty($model->collaboration)){
					$user2Col = new User2Collaboration();
					$user2Col->userId = $model->id;
					$user2Col->collaborationId = $model->collaboration;
					$user2Col->save();
				}
				
				if(!empty($model->partners)){
					foreach ($model->partners as $partnerId) {
						$user2Partner = new User2Partner();
						$user2Partner->userId = $model->id;
						$user2Partner->partnerId = $partnerId;
						$user2Partner->save();
					}
				}
				
				Yii::$app->session->setFlash('success', "User {$model->username} with rights {$model->role} successfully created.");
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldUsername = $model->username;
		
		$currentCollaboration = User2Collaboration::getCollaborationByUserId($model->id);
		$currentPartners = User2Partner::getPartnersByUserId($model->id);

        if ($model->load(Yii::$app->request->post())) {

            if(User::find()->where(['username' => $model->username])->exists() && $oldUsername != $model->username) {
                Yii::$app->session->setFlash('warning', "User with username {$model->username} exists! Choose a different username for the user.");

                return $this->render('update', [
                    'model' => $model,
                ]);

            }
			
			if(!empty($model->collaboration) && empty($currentCollaboration)){
				$user2Col = new User2Collaboration();
				$user2Col->userId = $model->id;
				$user2Col->collaborationId = $model->collaboration;
				$user2Col->save();
			} else if (!empty($model->collaboration && !empty($currentCollaboration))){
				$user2Col = User2Collaboration::find()->where(['userId' => $model->id])->one();
				$user2Col->collaborationId = $model->collaboration;
				$user2Col->save();
			}
	
			User2Partner::deleteAll(['userId' => $model->id]);
			foreach ($model->partners as $partnerId) {
				$user2Partner = new User2Partner();
				$user2Partner->userId = $model->id;
				$user2Partner->partnerId = $partnerId;
				$user2Partner->save();
			}

            $model->save();
            Yii::$app->session->setFlash('success', "The user {$model->username} with the name {$model->full_name} was successfully changed.");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
			$model->collaboration = $currentCollaboration->id;
			$model->partners = array_column($currentPartners, 'id');
		}

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdatePass($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "The user {$model->username} with the name {$model->full_name} was successfully changed.");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('updatePass', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->session->setFlash('danger', "The user {$this->findModel($id)->username} with the rights {$this->findModel($id)->role} was successfully deleted.");
	
		User2Collaboration::deleteAll(['userId' => $id]);
		User2Partner::deleteAll(['userId' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
