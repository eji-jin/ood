<?php

/* @var $this \yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $protocols array */

$this->title = 'Подозреваемые';
$this->params['breadcrumbs'][] = $this->title;
?>
<form>
    <?php foreach ($protocols as $index => $protocol): ?>
        <div class="form-group">
            <label for="suspect-<?= $index ?>">Подозреваемый</label>
            <input class="form-control" type="text" id="suspect-<?= $index ?>" value="<?= $protocol['suspect'] ?>" >
        </div>
        <div class="form-group">
            <label for="smth-else-<?= $index ?>">Еще какое-то поле</label>
            <input class="form-control" type="text" id="smth-else-<?= $index ?>" value="">
        </div>
    <?php endforeach; ?>
    <div class="form-group">
        <button type="submit" class="btn btn-success" disabled="disabled">Скачать</button>
    </div>
</form>

