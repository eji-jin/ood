<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DealSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дела';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Дело', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showHeader' => true,
        'summary' => 'Показаны {begin} - {end} из {totalCount} элементов',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'field_1',
            'field_2',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'viewProtocols' => function($url, $model, $key) {
                        return Html::a(
                                'Протоколы',
                                Url::toRoute(['protocol/index','ProtocolSearch[deal_id]' => $model['id']]),
                                [
                                    'class' => 'btn btn-success',
                                    'data-pjax' => 0
                                ]
                        );
                    },
                ],
                'template' => '{view} {update} {delete} {viewProtocols}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
