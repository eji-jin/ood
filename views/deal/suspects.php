<?php

/* @var $this \yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $protocols array */

$this->title = 'Подозреваемые';
$this->params['breadcrumbs'][] = $this->title;
?>
<form method="post" action="">
    <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
    <?php foreach ($protocols as $index => $protocol): ?>
        <div class="form-group">
            <label for="suspect-<?= $index ?>">Подозреваемый</label>
            <input name="suspects[<?= $index ?>][name]" class="form-control" type="text" id="suspect-<?= $index ?>" value="<?= $protocol['suspect'] ?>" >
        </div>
        <div class="form-group">
            <label for="smth-else-<?= $index ?>">Еще какое-то поле</label>
            <input name="suspects[<?= $index ?>][smth]" class="form-control" type="text" id="smth-else-<?= $index ?>" value="">
        </div>
    <?php endforeach; ?>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Скачать</button>
    </div>
</form>

