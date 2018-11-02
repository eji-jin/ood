<?php

namespace app\controllers;

use Yii;
use app\models\Reference;
use app\models\ReferenceSearch;
use app\models\SuspectsDownload;
use app\models\ReferenceDownload;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Deal;
use app\models\Protocol;

/**
 * ReferenceController implements the CRUD actions for Reference model.
 */
class ReferenceController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['useForms']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Reference models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReferenceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reference model.
     * @param integer $id
     * @param null $deal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $deal_id = null)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'deal_id' => $deal_id,
        ]);
    }

    /**
     * Creates a new Reference model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param null $deal_id
     * @return mixed
     */
    public function actionCreate($deal_id = null)
    {
        $model = new Reference();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'ReferenceSearch[deal_id]' => $deal_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'deal_id' => $deal_id
        ]);
    }

    /**
     * Updates an existing Reference model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param null $deal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $deal_id = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'deal_id' => $deal_id
        ]);
    }

    /**
     * Deletes an existing Reference model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param null $deal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id, $deal_id = null)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'ReferenceSearch[deal_id]' => $deal_id]);
    }

    /**
     * Finds the Reference model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reference the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reference::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDownload($deal_id)
    {
        (new ReferenceDownload())->getDocument($deal_id);
//        $this->goBack();
    }



    public function actionSuspects($id){

        if (\Yii::$app->request->isPost) {
            (new SuspectsDownload())->getDocument(\Yii::$app->request->post());
        }
        $deals = Deal::find()->where(['id' => $id])->asArray()->one();
        $protocols = Protocol::find()->where(['deal_id' => $id, 'roleInThis' => 'подозреваемый'])->asArray()->all();

        return $this->render('suspects',[
            'protocols' => $protocols,
            'deals'=>$deals
        ]);
    }
}
