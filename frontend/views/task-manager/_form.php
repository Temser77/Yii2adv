<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $users common\models\tables\Users */
/* @var $form yii\widgets\ActiveForm */
/* @var $rights */
/* @var $usersList */
/* @var $authUser */
/* @var $statuses */


?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php if ($rights): ?>
        <?= $form->field($model, 'creator_id')->dropDownList($usersList) ?>
    <?php endif; ?>


    <?php if (!$rights): ?>
        <?= $form->field($model, 'creator_id')->dropDownList(ArrayHelper::map($authUser, 'id', 'username')) ?>
    <?php endif; ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($usersList) ?>

    <?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'status_id')->dropDownList($statuses) ?>

    <div class="form-group">
        <?= Html::submitButton(\Yii::t('app','save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
