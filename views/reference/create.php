<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reference */

$this->title = 'Создать пункт справки';
$this->params['breadcrumbs'][] = ['label' => 'Пункты справки', 'url' => ['index', 'RererenceSearch[deal_id]' => $model['id']?: '']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
