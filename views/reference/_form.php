<?php

use app\models\Deal;
use app\models\Protocol;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reference */
/* @var $form yii\widgets\ActiveForm */
/* @var $deal_id number|null */
?>

<div class="reference-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deal_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(
            Deal::find()->select(['id','number'])->asArray()->all(),
            'id',
            'number'
        ),
        [
            'options' => isset($deal_id) ? [
                $deal_id => ['Selected' => 'selected']
            ] : [],
            'prompt' => 'Выберите дело'
        ])->label('Номер дела') ?>

    <?= $form->field($model, 'protocol_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(
            Protocol::find()->select(['id','suspect'])->asArray()->all(),
            'id',
            'suspect'
        ),
        [
            'options' => isset($deal_id) ? [
                $deal_id => ['Selected' => 'selected']
            ] : [],
            'prompt' => 'Выберите протокол'
        ])->label('Протокол') ?>

    <?php // $form->field($model, 'number')->textarea(['rows' => 6]) ?>

    <!--$form->field($model, 'evidence')->textarea(['rows' => 6]) -->

    <?= $form->field($model, 'claim')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'securofclaim')->textarea(['rows' => 2]) ?>

    <!--$form->field($model, 'guarantee')->textarea(['rows' => 6]) -->

    <?= $form->field($model, 'cost')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'aggcircum')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'excircum')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
