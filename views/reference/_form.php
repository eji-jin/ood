<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reference-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deal_id')->textInput() ?>

    <?= $form->field($model, 'number')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'evidence')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'claim')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'securofclaim')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'guarantee')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cost')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lawyer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dateofreview')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
