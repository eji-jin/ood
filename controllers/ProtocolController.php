<?php

namespace app\controllers;

use app\models\Reference;
use Yii;
use app\models\Protocol;
use app\models\ProtocolSearch;
use app\models\ProtocolDownload;
use app\models\Protocol1Download;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**s
 * ProtocolController implements the CRUD actions for Protocol model.
 */
class ProtocolController extends Controller
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
     * Lists all Protocol models.
     * @param null $deal_id
     * @return mixed
     */
    public function actionIndex($deal_id = null)
    {
        $searchModel = new ProtocolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Protocol model.
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
     * Creates a new Protocol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param null $deal_id
     * @return mixed
     */
    public function actionCreate($deal_id = null)
    {
        $model = new Protocol();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // создать пункт справки если роль в протоколе - подозреваемый
            if ($model->roleInThis === 'подозреваемый') {
                $reference = new Reference();
                $reference->deal_id = $model->deal_id;
                $reference->protocol_id = $model->id;
                $reference->save();
            }

            return $this->redirect(['view', 'id' => $model->id, 'deal_id' => $deal_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'deal_id' => $deal_id
        ]);
    }

    /**
     * Updates an existing Protocol model.
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
            return $this->redirect(['view', 'id' => $model->id, 'deal_id' => $deal_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Protocol model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $deal_id = null)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'ProtocolSearch[deal_id]' => $deal_id]);
    }

    /**
     * Finds the Protocol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Protocol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Protocol::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload($id)
    {
        (new ProtocolDownload())->getDocument($id);
//        $this->goBack();
    }
    public function actionDownload1($id)
    {
        (new Protocol1Download())->getDocument($id);
//        $this->goBack();
    }

}
