<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reference */
/* @var null $deal_id number */

$this->title = 'Редактировать Пункт Справки: ' . $model->id;
$this->params['breadcrumbs'][] = [
    'label' => 'Пункты Справки',
    'url' => ['index', 'ReferenceSearch[deal_id]' => $deal_id]
];
$this->params['breadcrumbs'][] = [
    'label' => $model->id,
    'url' => ['view', 'id' => $model->id, 'deal_id' => $deal_id]
];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="reference-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'deal_id' => $deal_id
    ]) ?>

</div>
