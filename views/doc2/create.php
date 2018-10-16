<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Document2 */

$this->title = 'Создание записи';
$this->params['breadcrumbs'][] = ['label' => 'Создание записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
