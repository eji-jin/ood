<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Справка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пункт справки', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Скачать', ['download', 'id' => \Yii::$app->request->get('ProtocolSearch')['deal_id']], ['class' => 'btn btn-success']) ?>
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
            'evidence:ntext',
            'claim:ntext',
            'securofclaim:ntext',
            'guarantee:ntext',
            'cost:ntext',
            'lawyer:ntext',
            'dateofreview:ntext',
            //'securofclaim:ntext',
            //'guarantee:ntext',
            //'cost:ntext',
            //'lawyer:ntext',
            //'dateofreview:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
            'dateFormat' => 'dd.MM.yyyy'
        ]
    ]); ?>
</div>
