<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProtocolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$deal_id = \Yii::$app->request->get('ProtocolSearch')['deal_id'];


$this->title = 'Протоколы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="protocol-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

        <?= Html::a(
                'Создать Протокол',
                ['create', 'deal_id' => isset($deal_id) ? $deal_id : ''],
                ['class' => 'btn btn-success']
        ) ?>



    </p>

    <?php try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            //        'filterModel' => $searchModel,
            'summary' => 'Показаны {begin} - {end} из {totalCount} элементов',
            'emptyText' => 'Элементы не найдены',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //            'id',
                [
                    'class' => 'yii\grid\DataColumn',

                    'attribute' => 'deal_id',
                    'content' => function ($model, $key, $index, $column) {
                        return \app\models\Deal::findOne($model->deal_id)['number'];
                    }


                ],
                'roleInThis',
                'suspect',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function ($action, $model, $key, $index) use ($deal_id) {
                        if ($action === 'view') {
                            $url = Url::to(['protocol/view', 'id' => $model->id, 'deal_id' => $deal_id ?: '']);
                            return $url;
                        }
                        if ($action === 'update') {
                            $url = Url::to(['protocol/update', 'id' => $model->id, 'deal_id' => $deal_id ?: '']);
                            return $url;
                        }
                        if ($action === 'delete') {
                            $url = Url::to(['protocol/delete', 'id' => $model->id, 'deal_id' => $deal_id ?: '']);
                            return $url;
                        }
                        return null;
                    }
                ],
            ],
        ]);
    } catch (Exception $e) {
        echo '<div class="alert alert-warning">' . (YII_DEBUG ? $e->getMessage(): 'Ошибка отображения виджета.' ) . '</div>';
    } ?>
    <?php Pjax::end(); ?>
</div>
