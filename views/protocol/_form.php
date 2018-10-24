<?php

use app\models\Deal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Protocol */
/* @var $form yii\widgets\ActiveForm */
/* @var $deal_id int */
?>

<div class="protocol-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deal_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(
                    Deal::find()->select(['id','field_1'])->asArray()->all(),
                    'id',
                    'field_1'
            ),
            [
                'options' => [
                    $deal_id => ['Selected' => 'selected']
                ]
            ]
    ) ?>

    <?= $form->field($model, 'field_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
