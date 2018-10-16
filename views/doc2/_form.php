<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Document2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document2-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo "Время начала допроса: ";
     $examp = date ("H:m");
        echo $examp;
        
        $months = array( 1 => 'Января' , 'Февраля' , 'Марта' , 'Апреля' , 'Мая' , 'Июня' , 'Июля' , 'Августа' , 'Сентября' , 'Октября' , 'Ноября' , 'Декабря' );
        $actualdate = date( 'd ' . $months[date( 'n' )] . ' Y' );
        ?>
        
    <?= $form->field($model, 'createdate')->textInput(['value'=>"$actualdate"]) ?>

    <?= $form->field($model, 'number')->textInput(['cols'=>10]) ?>

    <?= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'room')->textInput() ?>
    
    <hr>

    <?= $form->field($model, 'suspect')->textInput() ?>

    <?= $form->field($model, 'birthdate')->textInput() ?>

    <?= $form->field($model, 'birthplace')->textarea(['rows' => 3, cols=> 15]) ?>

    <?= $form->field($model, 'residence')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'nat')->textInput() ?>

    <?= $form->field($model, 'educat')->textInput() ?>

    <?= $form->field($model, 'famstat')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'workplace')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'duty')->textInput() ?>

    <?= $form->field($model, 'crime')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'pasport')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
