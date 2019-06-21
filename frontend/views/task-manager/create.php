<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $users common\models\tables\Users */
/* @var $statuses common\models\tables\Statuses */
/* @var $rights */
/* @var $usersList */
/* @var $authUser */

$this->title = \Yii::t('app', 'create_task');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usersList' => $usersList,
        'statuses' => $statuses,
        'rights' => $rights,
        'authUser' => $authUser
    ]) ?>

</div>
