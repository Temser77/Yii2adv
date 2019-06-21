<?php

use \yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model common\models\tables\Tasks */
/* @var $modelComments common\models\tables\Comments */
/* @var $hidecrumbs */
$this->title = $model->name;
if (!isset($hidecrumbs)) {
    $hidecrumbs = false;
}
if (!$hidecrumbs) {
    $this->params['breadcrumbs'][] = ['label' => \Yii::t('app','tasks'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
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
<?php if( Yii::$app->session->hasFlash('commentImgNotValidate') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('commentImgNotValidate'); ?>
    </div>
<?php endif;?>

<div class="card">
    <?= Html::beginTag('div', ['class' => ['card-body', $statusColorClass]]) ?>
    <?= Html::tag('h2', Html::encode($model->name), ['class' => 'card-title']) ?>
    <h4><?= $model->getAttributeLabel('creator_id') ?>: <?= $model->creator->username ?></h4>
    <h4><?= $model->getAttributeLabel('responsible_id') ?>: <?= $model->responsible->username ?></h4>
    <h4><?= $model->getAttributeLabel('deadline') ?>: <?= $model->deadline ?></h4>
    <?= Html::tag('p', Html::encode($model->description), ['class' => 'card-text']) ?>
    <hr>
    <p class="card-text">
        <small class="text-muted"><?= $model->getAttributeLabel('created') ?> <?= $model->created ?></small>
    </p>
    <p class="card-text">
        <small class="text-muted"><?= $model->getAttributeLabel('updated') ?> <?= $model->updated ?></small>
    </p>
    <?= Html::endTag('div') ?>
</div>

<div class="container-comments">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <?=Yii::t('app', 'comments')?>
                </div>
                <div class="panel-body comments">
                    <?php $form = ActiveForm::begin([
                        'id' => 'comments-form',
                        'options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($modelComments, 'description')->textarea([
                        'class' => 'form-control',
                        'placeholder' => Yii::t('app', 'leave_comment'),
                        'rows' => 7])->label(false)?>
                    <?= $form->field($modelComments, 'task_id')->hiddenInput(['value' => $model->id])->label(false)?>
                    <?= $form->field($modelComments, 'creator_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false)?>

                    <br>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <?= Html::a(Yii::t('app', 'login_or_register'), ['site/login'], ['class' => 'small pull-left']) ?>
                    <?php endif; ?>
                    <?= $form->field($modelComments, 'uploaded_file')->fileInput(['class' => 'field-comments-upload'])->label(false) ?>
                    <?= Html::submitButton(Yii::t('app', 'send'), ['class' => 'btn btn-info pull-right field-comments-submit']) ?>
                    <?php ActiveForm::end(); ?>

                    <hr>


                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'media-list'],
                        'itemView' => 'comments',
                        'viewParams' => ['hidecrumbs' => true],
                        'summary' => false,
                    ]);
                    ?>


                </div>
            </div>
        </div>
    </div>
</div>

