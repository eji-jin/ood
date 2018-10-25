<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProtocolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
                ['create', 'deal_id' => \Yii::$app->request->get('ProtocolSearch')['deal_id']],
                ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'summary' => 'Показаны {begin} - {end} из {totalCount} элементов',
        'emptyText' => 'Элементы не найдены',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'deal_id',
                'content' => function ($model, $key, $index, $column) {
                    return \app\models\Deal::findOne($model->deal_id)['number'];
                }
            ],
            'deal_id',
            'roleInThis',
            'suspect',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
