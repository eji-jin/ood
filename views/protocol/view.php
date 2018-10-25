<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Protocol */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Protocols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="protocol-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Скачать', ['download', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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

            'timeStart',
            'timeStop',
            'roleInThis',
            'createdate',
            'city',
            'room',
            'suspect',
            'birthdate',
            'nat',
            'educat',
            'famstat',
            'workplace',
            'duty',
            'otherPerson',
            'hardware',
            'incriminate',
            'birthplace',
            'residence',
            'crime',
            'pasport',
            'other',
            'indications',

        ],
    ]) ?>

</div>
