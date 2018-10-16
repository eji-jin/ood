<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Doc2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Документ 2';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document2-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новую запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Показаны {begin} - {end} из {totalCount} элементов",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'createdate:ntext',
            'number',
            //'rank:ntext',
            //'name:ntext',
            //'room:ntext',
            'suspect:ntext',
            //'birthdate:ntext',
            //'birthplace:ntext',
            //'residence:ntext',
            //'nat:ntext',
            //'educat:ntext',
            //'famstat:ntext',
            //'workplace:ntext',
            //'duty:ntext',
            //'crime:ntext',
            'pasport:ntext',

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
