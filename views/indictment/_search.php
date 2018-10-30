<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IndictmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indictment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'deal_id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'area') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'prosecutor') ?>

    <?php // echo $form->field($model, 'chiefposition') ?>

    <?php // echo $form->field($model, 'chiefrank') ?>

    <?php // echo $form->field($model, 'chiefname') ?>

    <?php // echo $form->field($model, 'handinfo') ?>

    <?php // echo $form->field($model, 'resolution') ?>

    <?php // echo $form->field($model, 'expertise') ?>

    <?php // echo $form->field($model, 'eviden') ?>

    <?php // echo $form->field($model, 'excircum') ?>

    <?php // echo $form->field($model, 'aggcircum') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
