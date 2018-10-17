<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Doc2Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document2-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?= $form->field($model, 'createdate') ?>

    <?= $form->field($model, 'number') ?>

    <?php // $form->field($model, 'rank') ?>

    <?php // $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'room') ?>

    <?= $form->field($model, 'suspect') ?>

    <?php // echo $form->field($model, 'birthdate') ?>

    <?php // echo $form->field($model, 'birthplace') ?>

    <?php // echo $form->field($model, 'residence') ?>

    <?php // echo $form->field($model, 'nat') ?>

    <?php // echo $form->field($model, 'educat') ?>

    <?php // echo $form->field($model, 'famstat') ?>

    <?php // echo $form->field($model, 'workplace') ?>

    <?php // echo $form->field($model, 'duty') ?>

    <?php // echo $form->field($model, 'crime') ?>

    <?= $form->field($model, 'pasport') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
