<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Protocol */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="protocol-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deal_id')->textInput() ?>

    <?= $form->field($model, 'field_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
