<?php

/* @var $this \yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $protocols array */
/* @var $deals array */

$this->title = 'Справка';
$this->params['breadcrumbs'][] = $this->title;
?>
<form method="post" action="">
    <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
    <?php foreach ($protocols as $index => $protocol):

        ?>


        <div class="form-group">
            <label for="suspect-<?= $index ?>">Подозреваемый</label>
            <input name="suspects[<?= $index ?>][name]" class="form-control" type="text" id="suspect-<?= $index ?>" value="<?= $protocol['suspect'] ?>" >
        </div>

        <div class="form-group">
            <label for="number-<?= $index ?>">Номер дела</label>
            <input name="suspects[<?= $index ?>][number]" class="form-control" type="text" id="number-<?= $index ?>" value="<?= $deals['number'] ?>" >
        </div>
        
        <div class="form-group">
            <label for="mp-<?= $index ?>">Мера пресечения</label>
            <input name="suspects[<?= $index ?>][mp]" class="form-control" type="text" id="mp-<?= $index ?>" value="">
        </div>
        
        <div class="form-group">
            <label for="evidence-<?= $index ?>">Вещественные доказательства</label>
            <input name="suspects[<?= $index ?>][evidence]" class="form-control" type="text" id="evidence-<?= $index ?>" value="">
        </div>
        <div class="form-group">
            <label for="gi-<?= $index ?>">Гражданский иск</label>
            <input name="suspects[<?= $index ?>][gi]" class="form-control" type="text" id="gi-<?= $index ?>" value="">
        </div>
        
        <div class="form-group">
            <label for="securofclaim-<?= $index ?>">Меры по обеспечению гражданского иска</label>
            <input name="suspects[<?= $index ?>][securofclaim]" class="form-control" type="text" id="securofclaim-<?= $index ?>" value="">
        </div>
        
        
        <div class="form-group">
            <label for="guarantee-<?= $index ?>">Меры по обеспечению прав иждивенцев</label>
            <input name="suspects[<?= $index ?>][guarantee]" class="form-control" type="text" id="guarantee-<?= $index ?>" value="">
        </div>
        <div class="form-group">
            <label for="cost-<?= $index ?>">Процессуальные издержки</label>
            <input name="suspects[<?= $index ?>][cost]" class="form-control" type="text" id="cost-<?= $index ?>" value="">
        </div>
        <div class="form-group">
            <label for="lawyer-<?= $index ?>">Защитник</label>
            <input name="suspects[<?= $index ?>][lawyer]" class="form-control" type="text" id="lawyer-<?= $index ?>" value="">
        </div>
        <div class="form-group">
            <label for="dateofreview-<?= $index ?>">Дата ознакомления</label>
            <input name="suspects[<?= $index ?>][dateofreview]" class="form-control" type="text" id="dateofreview-<?= $index ?>" value="">
        </div>
        <div class="form-group">
            <label for="sent-<?= $index ?>">Куда направлено</label>
            <input name="suspects[<?= $index ?>][sent]" class="form-control" type="text" id="sent-<?= $index ?>" value="">
        </div>
        
        <div>
        <hr noshade size=5>
        </div>
    <?php endforeach;?>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Скачать</button>
    </div>
</form>

