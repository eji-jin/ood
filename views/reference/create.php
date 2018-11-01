<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reference */
/* @var null $deal_id number */

$this->title = 'Создать пункт справки';
$this->params['breadcrumbs'][] = ['label' => 'Пункты справки', 'url' => ['index', 'RererenceSearch[deal_id]' => $deal_id?: '']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'deal_id' => $deal_id
    ]) ?>

</div>
