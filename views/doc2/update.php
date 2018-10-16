<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Document2 */

$this->title = 'Редактировать документ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Document2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="document2-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
