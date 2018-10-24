<?php

use app\models\Deal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Protocol */
/* @var $form yii\widgets\ActiveForm */

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
                ],
                'prompt' => 'Выберите дело'
            ]
    ) ?>
<<<<<<< HEAD
    <?= $form->field($model, 'timeStart')->textInput() ?>
    <?= $form->field($model, 'roleInThis')->textInput() ?>

    <?= $form->field($model, 'createdate')->textInput() ?>
    <?= $form->field($model, 'city')->textInput() ?>
    <?= $form->field($model, 'room')->textInput() ?>
    <?= $form->field($model, 'suspect')->textInput() ?>
    <?= $form->field($model, 'birthdate')->textInput() ?>
    <?= $form->field($model, 'birthplace')->textarea(['rows' => 1]) ?>
    <?= $form->field($model, 'residence')->textarea(['rows' => 1]) ?>
    <?= $form->field($model, 'nat')->textInput() ?>
    <?= $form->field($model, 'educat')->textInput() ?>
    <?= $form->field($model, 'famstat')->textInput() ?>
    <?= $form->field($model, 'workplace')->textInput() ?>
    <?= $form->field($model, 'duty')->textInput() ?>
    <?= $form->field($model, 'crime')->textarea(['rows' => 1]) ?>
    <?= $form->field($model, 'pasport')->textInput() ?>
    <?= $form->field($model, 'other')->textarea(['rows' => 2]) ?>
    <?= $form->field($model, 'otherPerson')->textInput() ?>
    <?= $form->field($model, 'hardware')->textInput() ?>
    <?= $form->field($model, 'incriminate')->textarea(['rows' => 2]) ?>
    <?= $form->field($model, 'indications')->textarea(['rows' => 2]) ?>
    <?= $form->field($model, 'timeStop')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
