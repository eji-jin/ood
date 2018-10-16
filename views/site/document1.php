<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Document1 */
/* @var $form ActiveForm */
?>
<div class="site-document1">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'number') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'workplace') ?>
        <?= $form->field($model, 'post') ?>
        <?= $form->field($model, 'for') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-document1 -->
