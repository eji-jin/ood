<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Protocol */
$deal_id = \Yii::$app->request->get('deal_id');

$this->title = $model->suspect;
$this->params['breadcrumbs'][] = [
    'label' => 'Протоколы',
    'url' => ['index', 'ProtocolSearch[deal_id]' => isset($deal_id) ? $deal_id : '' ]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="protocol-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id, 'deal_id' => $deal_id ?: ''], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Скачать', ['download', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        
        
        <?= Html::a('Справка', ['download1', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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
