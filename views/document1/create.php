<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Document1 */

$this->title = 'Создать документ 1';
$this->params['breadcrumbs'][] = ['label' => 'Document1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
