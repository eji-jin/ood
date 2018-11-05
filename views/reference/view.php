<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reference */
/* @var null $deal_id number */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Справка', 'url' => ['index', 'ReferenceSearch[deal_id]' => $model['deal_id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
                'Редактировать',
                ['update', 'id' => $model->id, 'deal_id' => $deal_id],
                ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id,  'deal_id' => $deal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php try {
         echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'deal_id',
                    'label' => 'Номер дела',
                    'content' => function ($model) {
                        echo \app\models\Deal::findOne($model['deal_id'])['number'];
                    },
                ],
                'evidence:ntext',
                'claim:ntext',
                'securofclaim:ntext',
                'guarantee:ntext',
                'cost:ntext',
                'lawyer:ntext',
                'dateofreview:ntext',
                'aggcircum:ntext',
                'excircum:ntext',
            ],
            'formatter' => [
                'class' => yii\i18n\Formatter::className(),
                'nullDisplay' => '-'
            ]
        ]);
    } catch (Exception $e) {
        echo '<div class="alert alert-warning">' . (YII_DEBUG ? $e->getMessage() : 'Ошибка отображения виджета.') . '</div>';
    } ?>

</div>
