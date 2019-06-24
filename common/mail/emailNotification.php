<?php
/**
 * Created by PhpStorm.
 * User: post.user14
 * Date: 22.05.2019
 * Time: 16:51
 */
use yii\helpers\Html;
/* @var $task app\models\tables\Tasks */
?>
<h3 class="card-title">Вы получили новую задачу</h3>
<?= Html::a($task->name, 'http://localhost/myshop.local/web/index.php?r=task-manager%2Fview&id=' . $task->id, ['class' => 'card-title']) ?>
<p class="card-title">Задача поставлена <?=$task->creator->username?></p>
<p class="card-text"><?=$task->description?></p>
<p class="card-title">Дедлайн <?=$task->deadline?></p>

