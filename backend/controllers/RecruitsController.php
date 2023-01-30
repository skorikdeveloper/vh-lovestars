<?php

namespace backend\controllers;

use app\models\AddressesActual;
use app\models\AddressesRegistration;
use app\models\Rank;
use Yii;
use app\models\Recruits;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;

/**
 * RecruitsController implements the CRUD actions for Recruits model.
 */
class RecruitsController extends AppController
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
                        'actions' => ['index', 'create', 'view', 'update', 'create-by-passport'],
                        'allow' => true,
                        'roles' => [User::ROLE_USER],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => false,
                        'denyCallback' => function($rule, $admin) {
                            return $this->redirect(Url::to(['site/no-access']));
                        },
                        'roles' => [User::ROLE_USER],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Recruits models.
     * @return mixed
     */
    public function actionIndex()
    {
      $query = Recruits::find();
      if(!empty(Yii::$app->request->get())) $query = Recruits::filterRecruits();

      $this->setMeta('Призовники');
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
     * Displays a single Recruits model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Recruits model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Recruits();
        $addresses_registration = new AddressesRegistration();
        $addresses_actual = new AddressesActual();

        if (
          $model->load(Yii::$app->request->post()) &&
          $addresses_registration->load(Yii::$app->request->post()) &&
          $addresses_actual->load(Yii::$app->request->post())
        ) {
          $model->who_carried = Yii::$app->user->identity->id;
          $model->date_of_getting_povestka = date('d/m//Y H:i:s');

          $findRecruit = Recruits::find()->where(['passport_series' => $model->passport_series])->andWhere(['passport_number' => $model->passport_number])->one();

          if($findRecruit !== NULL) {
            Yii::$app->session->setFlash('error', "Призовник {$model->first_name} с таким паспортом вже доданий у систему.");
            return $this->render('create', [
              'model' => $model,
              'addresses_registration' => $addresses_registration,
              'addresses_actual' => $addresses_actual,
            ]);
          }

          if($model->save()) {

            $addresses_registration->recruit_id = $model->id;
            $addresses_registration->save();

            $addresses_actual->recruit_id = $model->id;
            $addresses_actual->save();

            Yii::$app->session->setFlash('success', "Призовник {$model->first_name} доданий.");
            return $this->redirect(['view', 'id' => $model->id]);
          }
        }

        return $this->render('create', [
            'model' => $model,
            'addresses_registration' => $addresses_registration,
            'addresses_actual' => $addresses_actual,
        ]);
    }

  /**
   * Creates a new Recruits model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreateByPassport()
  {
    $model = new Recruits();
    $addresses_registration = new AddressesRegistration();
    $addresses_actual = new AddressesActual();

    if ($model->load(Yii::$app->request->post()) ) {
      $findRecruit = Recruits::find()->where(['passport_series' => $model->passport_series])->andWhere(['passport_number' => $model->passport_number])->one();

      if($findRecruit !== NULL) {
        Yii::$app->session->setFlash('success', "Призовник {$model->first_name} вже доданий у систему.");
        return $this->redirect(['view', 'id' => $findRecruit->id]);
      } else {
        $model->who_carried = Yii::$app->user->identity->id;
        $model->date_of_getting_povestka = date('d/m//Y H:i:s');
        if($model->save(false)) {

          $addresses_registration->recruit_id = $model->id;
          $addresses_registration->save(false);

          $addresses_actual->recruit_id = $model->id;
          $addresses_actual->address_same_as_registration = '1';
          $addresses_actual->save(false);

          Yii::$app->session->setFlash('success', "Призовник успішно доданий у систему.");
          return $this->redirect(['update', 'id' => $model->id]);
        }
      }
    }

    return $this->render('create_by_passport', [
      'model' => $model,
    ]);
  }

    /**
     * Updates an existing Recruits model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $addresses_registration = AddressesRegistration::find()->where(['recruit_id' => $model->id])->one();
        $addresses_actual = AddressesActual::find()->where(['recruit_id' => $model->id])->one();

        $old_pasport_series = $model->passport_series;
        $old_pasport_number = $model->passport_number;

        if (
          $model->load(Yii::$app->request->post()) &&
          $addresses_registration->load(Yii::$app->request->post()) &&
          $addresses_actual->load(Yii::$app->request->post())
        ) {

          $findRecruit = Recruits::find()->where(['passport_series' => $model->passport_series])->andWhere(['passport_number' => $model->passport_number])->one();

          if($findRecruit !== NULL && $findRecruit->id !== $model->id) {
            $model->passport_number = $old_pasport_number;
            $model->passport_series = $old_pasport_series;
            Yii::$app->session->setFlash('error', "Призовник {$model->first_name} с таким паспортом вже доданий у систему.");
            return $this->render('update', [
              'model' => $model,
              'addresses_registration' => $addresses_registration,
              'addresses_actual' => $addresses_actual,
            ]);
          }

          if($model->save() && $addresses_registration->save() && $addresses_actual->save()) {
            Yii::$app->session->setFlash('success', "Призовника {$model->first_name} змінено.");
            return $this->redirect(['view', 'id' => $model->id]);
          }
        }

        return $this->render('update', [
            'model' => $model,
            'addresses_registration' => $addresses_registration,
            'addresses_actual' => $addresses_actual,
        ]);
    }

    /**
     * Deletes an existing Recruits model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->session->setFlash('danger', "Призовник {$this->findModel($id)->first_name} видалений.");

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Recruits model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Recruits the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recruits::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
