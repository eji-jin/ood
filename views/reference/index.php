<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$deal_id = \Yii::$app->request->get('ReferenceSearch')['deal_id'];

$this->title = 'Справка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- Html::a('Создать пункт справки', ['create', 'deal_id' =>  $deal_id ?: ''], ['class' => 'btn btn-success']) -->
        <?= Html::a('Скачать', ['download', 'deal_id' => $deal_id ?: ''], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => '<p>Показано <b>{begin}-{end}</b> из <b>{totalCount}</b> элементов.</p>',
        'options' => [
            'style' => 'word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'deal_id',
                'label' => 'Номер дела',
                'content' => function ($model, $key, $index, $column) {
                    return \app\models\Deal::findOne($model->deal_id)['number'];
                }


            ],
            [
                'class' => yii\grid\DataColumn::className(),
                'content' => function($model) {
                    $protocol = \app\models\Protocol::findOne($model->protocol_id);
                    return $protocol->suspect;
                },
                'label' => 'ФИО'
            ],
            //'evidence:ntext',
            'claim:ntext',
            'securofclaim:ntext',
            //'guarantee:ntext',
            //'cost:ntext',
            //'lawyer:ntext',
            //'dateofreview:ntext',
            //'securofclaim:ntext',
            //'guarantee:ntext',
            //'cost:ntext',
            //'lawyer:ntext',
            //'dateofreview:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) use ($deal_id) {
                    if ($action === 'view') {
                        $url = Url::to(['reference/view', 'id' => $model->id, 'deal_id' => $deal_id ?: '']);
                        return $url;
                    }
                    if ($action === 'update') {
                        $url = Url::to(['reference/update', 'id' => $model->id, 'deal_id' => $deal_id ?: '']);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = Url::to(['reference/delete', 'id' => $model->id, 'deal_id' => $deal_id ?: '']);
                        return $url;
                    }
                    return null;
                }
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
            'dateFormat' => 'dd.MM.yyyy'
        ]
    ]); ?>
</div>
