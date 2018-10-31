<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Protocol */
/* @var $deal_id int */

$this->title = 'Создать протокол';
$this->params['breadcrumbs'][] = [
    'label' => 'Протоколы',
    'url' => ['index', 'ProtocolSearch[deal_id]' => $deal_id?: ''],
];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="protocol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'deal_id' => \Yii::$app->request->get('deal_id')
    ]) ?>

</div>
