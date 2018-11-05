<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput() ?>


    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'rank')->textInput() ?>
        
    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'officer')->textInput() ?>
    <?= $form->field($model, 'deal_area')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
