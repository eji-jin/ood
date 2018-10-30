<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Indictment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indictment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deal_id')->textInput() ?>

    <?= $form->field($model, 'number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'area')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'prosecutor')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chiefposition')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chiefrank')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chiefname')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'handinfo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'resolution')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'expertise')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'eviden')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'excircum')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aggcircum')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
