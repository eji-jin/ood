<?php

namespace app\controllers;

use app\models\IndictmentForm;
use app\models\Protocol;
use Yii;
use app\models\Indictment;
use app\models\IndictmentSearch;
use app\models\IndictmentDownload;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * IndictmentController implements the CRUD actions for Indictment model.
 */
class IndictmentController extends Controller
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
     * Lists all Indictment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndictmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Indictment model.
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
     * Creates a new Indictment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Indictment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Indictment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Indictment model.
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
     * Finds the Indictment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Indictment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Indictment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionForm($deal_id)
    {


        if (\Yii::$app->request->isPost) {
            (new IndictmentForm())->save(\Yii::$app->request->post());
        }

        $model = Indictment::findOne(['deal_id' => $deal_id]);

        $suspects = Protocol::findAll(['roleInThis' => 'подозреваемый']);
        $notSuspects = Protocol::find()->where(['!=', 'roleInThis', 'подозреваемый'])->all();
        $meta = (new Query())->select(['protocol_id', 'value'])->from('indictment_protocol')->where(['indictment_id' => $model->id])->all();
        $meta = ArrayHelper::map($meta, 'protocol_id', 'value');


        return $this->render('form', [
            'deal_id' => $deal_id,
            'model' => $model,
            'suspects' => $suspects,
            'notSuspects' => $notSuspects,
            'meta' => $meta
        ]);
    }
}
