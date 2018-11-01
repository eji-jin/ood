<?php

use app\models\Deal;
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

    <?php // $form->field($model, 'number')->textarea(['rows' => 6]) ?>

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
