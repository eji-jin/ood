<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReferenceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reference-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'deal_id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'evidence') ?>

    <?= $form->field($model, 'claim') ?>

    <?php // echo $form->field($model, 'securofclaim') ?>

    <?php // echo $form->field($model, 'guarantee') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'lawyer') ?>

    <?php // echo $form->field($model, 'dateofreview') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
