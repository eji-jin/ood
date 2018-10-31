<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Дела', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',

                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'number',
            'position',
            'rank',
            'name',
            'officer',

        ],
    ]) ?>

</div>
