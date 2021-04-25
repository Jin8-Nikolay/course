<?php

namespace backend\controllers;

use common\models\RentalDescription;
use common\models\User;
use Yii;
use common\models\Rental;
use common\models\RentalSearch;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RentalController implements the CRUD actions for Rental model.
 */
class RentalController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
//                    if ($action->id === 'create') {
//                        return $action->controller->redirect('/admin/rental');
//                    }
//                    else if ($action->id === 'view') {
//                        return $action->controller->redirect('/admin/rental');
//                    }
//                    else if ($action->id === 'delete') {
//                        return $action->controller->redirect('/admin/rental');
//                    }
                    if (!Yii::$app->user->isGuest) {
                        Yii::$app->user->logout();
                        throw new HttpException('404', 'Page not found');
                    }
                    return $action->controller->redirect('/');
                },
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => [User::ACCESS_DASHBOARD],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [User::ACCESS_CREATE_RENTAL],
                    ],
//                    [
//                        'actions' => ['index'],
//                        'allow' => true,
//                        'roles' => [User::ACCESS_DASHBOARD],
//                    ],
//                    [
//                        'actions' => ['view'],
//                        'allow' => true,
//                        'roles' => [User::ACCESS_VIEW_RENTAL],
//                    ],
//                    [
//                        'actions' => ['update'],
//                        'allow' => true,
//                        'roles' => [User::ACCESS_UPDATE_RENTAL],
//                    ],
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
     * Lists all Rental models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RentalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rental model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (\Yii::$app->user->can('viewRent', ['rental' => $model])) {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
        return $this->redirect('index');

    }

    /**
     * Creates a new Rental model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rental();
        $description = new RentalDescription();
//        echo '<pre>';
//        var_dump(Yii::$app->request->post('Rental'));
//        var_dump($model->load(Yii::$app->request->post('Rental')));
//        echo '</pre>';
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            $post['RentalDescription']['id_rental'] = $model->id;
            if ($description->load($post) && $description->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'description' => $description,
        ]);
    }

    /**
     * Updates an existing Rental model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $description = $this->findModelDescription($id);

        if (\Yii::$app->user->can('updateRent', ['rental' => $model])) {
            $post = Yii::$app->request->post();

            if ($model->load($post) && $model->save()) {
                $post['RentalDescription']['id_rental'] = $model->id;
                if ($description->load($post) && $description->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'description' => $description,
            ]);
        }
        return $this->redirect('index');
    }

    /**
     * Deletes an existing Rental model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $description = $this->findModelDescription($id);
        if (\Yii::$app->user->can('deleteRent', ['rental' => $model])) {
            $description->delete();
            $model->delete();
            return $this->redirect(['index']);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Rental model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rental the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rental::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelDescription($id)
    {
        if (($model = RentalDescription::find()->where(['id_rental' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
