<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Document2 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Document2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document2-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Протокол допроса', ['download', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обвинительный акт', ['download1', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'createdate:ntext',
            'number',
            'rank:ntext',
            'name:ntext',
            'room:ntext',
            'suspect:ntext',
            'birthdate:ntext',
            'birthplace:ntext',
            'residence:ntext',
            'nat:ntext',
            'educat:ntext',
            'famstat:ntext',
            'workplace:ntext',
            'duty:ntext',
            'crime:ntext',
            'pasport:ntext',
        ],
    ]) ?>

</div>
