<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\filters\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $usersList */
/* @var $FilterCacheKey */

\yii\web\YiiAsset::register($this);
$this->title = \Yii::t('app', 'tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(\Yii::t('app', 'create_task'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'usersList' => $usersList
    ]); ?>

    <?php

    if ($this->beginCache($FilterCacheKey, [
        'duration' => 1,
        'variations' => Yii::$app->language,
    ])) {
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'view',
        'viewParams' => ['hidecrumbs' => true],
        'summary' => false,
    ]);
        $this->endCache();
    }

    ?>


</div>
