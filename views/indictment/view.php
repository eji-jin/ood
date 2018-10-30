<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Indictment */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Indictments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indictment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'deal_id',
            'number:ntext',
            'area:ntext',
            'title:ntext',
            'prosecutor:ntext',
            'chiefposition:ntext',
            'chiefrank:ntext',
            'chiefname:ntext',
            'handinfo:ntext',
            'resolution:ntext',
            'expertise:ntext',
            'eviden:ntext',
            'excircum:ntext',
            'aggcircum:ntext',
        ],
    ]) ?>

</div>
