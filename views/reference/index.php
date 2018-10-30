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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'deal_id',
            'number:ntext',
            'evidence:ntext',
            'claim:ntext',
            //'securofclaim:ntext',
            //'guarantee:ntext',
            //'cost:ntext',
            //'lawyer:ntext',
            //'dateofreview:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>