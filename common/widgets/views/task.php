<?php

use yii\helpers\Html;
//use Yii;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $hidecrumbs */

switch ($model->status_id) {
    case 1:
        $statusColorClass = 'alert alert-secondary';
        break;
    case 2:
        $statusColorClass = 'alert alert-warning';
        break;
    case 3:
        $statusColorClass = 'alert alert-primary';
        break;
    case 4:
        $statusColorClass = 'alert alert-success';
        break;
    case 5:
        $statusColorClass = 'alert alert-danger';
        break;

}

?>

<div class="card">

        <?= Html::beginTag('div', ['class' => ['card-body', $statusColorClass]])?>
        <?= Html::tag('h2', Html::encode($model->name), ['class' => 'card-title']) ?>
    <?= Html::tag('h3', Html::encode($model->responsible->username), ['class' => 'card-title']) ?>
        <?= Html::tag('p', Html::encode($model->description), ['class' => 'card-text']) ?>
        <div class="item-buttons-group">
            <?= Html::a(Yii::t('app', 'view'), ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'change'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(Yii::t('app', 'delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <?= Html::endTag('div')?>

</div>