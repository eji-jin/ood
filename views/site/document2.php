<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Document2 */
/* @var $form ActiveForm */
?>
<div class="site-document2">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id') ?>
        <?= $form->field($model, 'createdate') ?>
        <?= $form->field($model, 'number') ?>
        <?= $form->field($model, 'rank') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'room') ?>
        <?= $form->field($model, 'suspect') ?>
        <?= $form->field($model, 'birthdate') ?>
        <?= $form->field($model, 'birthplace') ?>
        <?= $form->field($model, 'residence') ?>
        <?= $form->field($model, 'nat') ?>
        <?= $form->field($model, 'educat') ?>
        <?= $form->field($model, 'famstat') ?>
        <?= $form->field($model, 'workplace') ?>
        <?= $form->field($model, 'duty') ?>       
        <?= $form->field($model, 'crime') ?>
        <?= $form->field($model, 'pasport') ?>    
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-document2 -->
