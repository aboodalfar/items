<?php

namespace app\controllers;

use Yii;
use app\models\PreparedMaterials;
use app\models\PreparedMaterialsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\form\PreparedMaterialsForm;

/**
 * PreparedMaterialsController implements the CRUD actions for PreparedMaterials model.
 */
class PreparedMaterialsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PreparedMaterials models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreparedMaterialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PreparedMaterials model.
     * @param integer $id
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
     * Creates a new PreparedMaterials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //$model = new PreparedMaterials();

        $model = new PreparedMaterialsForm();
        $model->Preparedmaterials = new PreparedMaterials;
        $model->Preparedmaterials->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());
//var_dump( $model->load(Yii::$app->request->post()),   Yii::$app->request->post());die;

        if (Yii::$app->request->post() && $model->save()) {
        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Preparedmaterials->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PreparedMaterials model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        //$model = $this->findModel($id);
        $model = new PreparedMaterialsForm();
        $model->Preparedmaterials = $this->findModel($id);
        $model->setAttributes(Yii::$app->request->post());
//var_dump($model->Preparedmaterials->name);die;
        if (Yii::$app->request->post() && $model->save()) {
        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Preparedmaterials->id]);
        }
//var_dump($model->Preparedmaterials->name);die;
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PreparedMaterials model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PreparedMaterials model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PreparedMaterials the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PreparedMaterials::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
