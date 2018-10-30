<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Indictment */

$this->title = 'Create Indictment';
$this->params['breadcrumbs'][] = ['label' => 'Indictments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indictment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
