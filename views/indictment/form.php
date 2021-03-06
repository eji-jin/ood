<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Indictment */
/* @var $suspects \app\models\Protocol[] */
/* @var $notSuspects \app\models\Protocol[] */
/* @var $meta array */

/* @var $deal_id number */


$this->title = 'Обвинительный акт';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--    <pre>-->
<!--        --><?php //var_dump($meta); ?>
<!--        --><?php //var_dump(\Yii::$app->request->post()); ?>
<!--    </pre>-->

    <h1><?= Html::encode($this->title) ?></h1>


        <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
        <form id="indictment-form" method="post" class="form-horizontal" >

            <div class="form-group">
                <label class="col-lg-3" for="area">Дата возбуждения уголовного дела</label>
                <div class="col-lg-9">
                    <input id="area" class="form-control" name="indictment[date_indict]" value="<?= $model->date_indict  ?>" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3" for="area">Район</label>
                <div class="col-lg-9">
                    <input id="area" class="form-control" name="indictment[area]" value="<?= $model->area  ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="title">Звание прокурора</label>
                <div class="col-lg-9">
                    <input id="title" class="form-control" name="indictment[title]" value="<?= $model->title  ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="prosecutor">ФИО прокурора</label>
                <div class="col-lg-9">
                    <input id="prosecutor" class="form-control" name="indictment[prosecutor]" value="<?= $model->prosecutor  ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="chiefposition">Должность начальника</label>
                <div class="col-lg-9">
                    <input id="chiefposition" class="form-control" name="indictment[chiefposition]" value="<?= $model->chiefposition  ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="chiefrank">Звание начальника</label>
                <div class="col-lg-9">
                    <input id="area" class="form-control" name="indictment[chiefrank]" value="<?= $model->chiefrank  ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="chiefname">ФИО начальника</label>
                <div class="col-lg-9">
                    <input id="chiefname" class="form-control" name="indictment[chiefname]" value="<?= $model->chiefname  ?>" >
                </div>
            </div>
            <div class="form-group">



        <?php foreach ($suspects as $index => $suspect): ?>
            <p class="lead"><?= $suspect->suspect; ?></p>
            <div class="form-group">
                <label class="col-lg-3" for="suspect-<?= $index ?>">Обстоятельства</label>
                <div class="col-lg-9">
                    <textarea id="suspect-<?= $index ?>" class="form-control" name="meta[<?= $index; ?>][value]"><?= $meta[$suspect->id][value];  ?></textarea>>
                </div>
                <input type="hidden" name="meta[<?= $index; ?>][deal_id]" value="<?= $suspect->deal_id; ?>">
                <input type="hidden" name="meta[<?= $index; ?>][protocol_id]" value="<?= $suspect->id; ?>">
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="suspect-<?= $index ?>">Отягчающие</label>
                <div class="col-lg-9">
                    <input id="suspect-<?= $index ?>" class="form-control" name="meta[<?= $index; ?>][otyagch]" value="<?= $meta[$suspect->id][otyagch];  ?>" >
                </div>
                <input type="hidden" name="meta[<?= $index; ?>][deal_id]" value="<?= $suspect->deal_id; ?>">
                <input type="hidden" name="meta[<?= $index; ?>][protocol_id]" value="<?= $suspect->id; ?>">
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="suspect-<?= $index ?>">Смягчающие</label>
                <div class="col-lg-9">
                    <input id="suspect-<?= $index ?>" class="form-control" name="meta[<?= $index; ?>][smyagch]" value="<?= $meta[$suspect->id][smyagch];  ?>" >
                </div>
                <input type="hidden" name="meta[<?= $index; ?>][deal_id]" value="<?= $suspect->deal_id; ?>">
                <input type="hidden" name="meta[<?= $index; ?>][protocol_id]" value="<?= $suspect->id; ?>">
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="suspect-<?= $index ?>">Процессуальные издержки</label>
                <div class="col-lg-9">
                    <input id="suspect-<?= $index ?>" class="form-control" name="meta[<?= $index; ?>][costs]" value="<?= $meta[$suspect->id][costs];  ?>" >
                </div>
                <input type="hidden" name="meta[<?= $index; ?>][deal_id]" value="<?= $suspect->deal_id; ?>">
                <input type="hidden" name="meta[<?= $index; ?>][protocol_id]" value="<?= $suspect->id; ?>">
            </div>
            <div class="form-group">
                <label class="col-lg-3" for="suspect-<?= $index ?>">Мера принуждения</label>
                <div class="col-lg-9">
                    <input id="suspect-<?= $index ?>" class="form-control" name="meta[<?= $index; ?>][mera_prin]" value="<?= $meta[$suspect->id][mera_prin];  ?>" >
                </div>
                <input type="hidden" name="meta[<?= $index; ?>][deal_id]" value="<?= $suspect->deal_id; ?>">
                <input type="hidden" name="meta[<?= $index; ?>][protocol_id]" value="<?= $suspect->id; ?>">
            </div>

        <?php endforeach; ?>
        <hr>
        <?php foreach ($notSuspects as $index => $notSuspect): ?>
            <p class="lead"><?=$notSuspect->roleInThis, ' ', $notSuspect->suspect; ?></p>
            <div class="form-group">
                <label class="col-lg-3" for="suspect-<?= $index ?>">Показания</label>
                <div class="col-lg-9">
                    <textarea id="suspect-<?= $index ?>" class="form-control" name="notsuspects[<?= $index; ?>][value]"><?= $notSuspect->indications  ?></textarea>
                </div>
                <input type="hidden" name="notsuspects[<?= $index; ?>][protocol_id]" value="<?= $notSuspect->id; ?>">
            </div>
        <?php endforeach; ?>
        <hr>

        <input type="hidden" name="indictment[deal_id]" value="<?= $deal_id; ?>">


                <label class="col-lg-3" for="expertise">Гражданский иск</label>
                <div class="col-lg-9">
                    <input id="expertise" class="form-control" name="indictment[expertise]" value="<?= $model->expertise  ?>" >
                </div>
            </div>

        <div class="form-group">
            <label class="col-lg-3" for="eviden">Вещественные доказательства</label>
            <div class="col-lg-9">
                <textarea id="eviden" class="form-control" name="indictment[eviden]"><?= $model->eviden  ?></textarea>
            </div>
        </div>
            <div class="form-group">
                <label class="col-lg-3" for="evidences">Прочие доказательства, рапорта, заключения, справки, протоколы</label>
                <div class="col-lg-9">
                    <textarea id="evidences" class="form-control" name="indictment[evidences]"><?= $model->evidences  ?></textarea>
                </div>
            </div>

        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                <?= Html::submitButton('Сохранить',
                    [
                        'class' => 'btn btn-success',
                        //'onClick' => "document.getElementById('indictment-form').action = '/indictment/form?deal_id=" . $deal_id . "';"
                    ]) ?>
                <?php Html::submitButton('Сохранить и скачать',
                [
                            'class' => 'btn btn-primary',
                            'onClick' => "document.getElementById('indictment-form').action = '/indictment/download?deal_id=" . $deal_id . "';"
                ]) ?>
            </div>
        </div>
    </form>
    <form method="post" class="form-horizontal" action="<?= \yii\helpers\Url::to(['indictment/download', 'deal_id' => $deal_id])?>">
        <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                <?= Html::submitButton('Cкачать',
                    [
                        'class' => 'btn btn-primary'
                    ]) ?>
            </div>
        </div>
    </form>
