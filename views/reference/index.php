<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a('Скачать', '#', ['class' => 'btn btn-success', 'onclick' => 'alert("Сделать формирование документа!");']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'summary' => '<p>Показано <b>{begin}-{end}</b> из <b>{totalCount}</b> элементов.</p>',
        'options' => [
            'style' => 'word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'deal_id',
//            'number:ntext',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
            'dateFormat' => 'dd.MM.yyyy'
        ]
    ]); ?>
</div>
