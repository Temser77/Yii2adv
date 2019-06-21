<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\filters\TasksFilter */
/* @var $form yii\widgets\ActiveForm */
/* @var $usersList */
?>

<div class="tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'created')->textInput(['type' => 'month']) ?>

    <?php // $form->field($model, 'description') ?>

    <?= $form->field($model, 'creator_id')->dropDownList($usersList) ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($usersList) ?>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton(\Yii::t('app', 'search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(\Yii::t('app', 'reset'), ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
