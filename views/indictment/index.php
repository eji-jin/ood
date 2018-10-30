<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IndictmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Indictments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indictment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Indictment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'deal_id',
            'number:ntext',
            'area:ntext',
            'title:ntext',
            //'prosecutor:ntext',
            //'chiefposition:ntext',
            //'chiefrank:ntext',
            //'chiefname:ntext',
            //'handinfo:ntext',
            //'resolution:ntext',
            //'expertise:ntext',
            //'eviden:ntext',
            //'excircum:ntext',
            //'aggcircum:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
