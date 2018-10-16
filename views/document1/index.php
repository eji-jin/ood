<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Document1Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Документ 1';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document1-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать документ 1', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Показаны {begin} - {end} из {totalCount} элементов",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'name:ntext',
            'workplace:ntext',
            'post:ntext',
            //'for:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{download} {view} {update} {delete}',
                'buttons' => [
                    'download' => function($url, $model, $key) {
//                        return '<a href=""><span class="glyphicon glyphicon-download-alt"></span></a>';
                        return Html::a(
                                Html::tag('span','',['class' => 'glyphicon glyphicon-download-alt']),
                                $url,
                                ['data-pjax' => 0 ]
                        );
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
