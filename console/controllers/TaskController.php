<?php
/**
 * Created by PhpStorm.
 * User: post.user14
 * Date: 13.06.2019
 * Time: 16:03
 */

namespace app\commands;


use app\models\tables\Tasks;
use yii\console\Controller;
use yii\helpers\Console;
use Yii;

class TaskController extends Controller
{
    /**
     * Send emails to all resposible users when task deadline is tomorrow
     */
    public function actionNotify() {
        echo 'START';
        $date = date('Y-m-d', strtotime('+1 day'));
        $tasks = Tasks::find()->where(['<','deadline',$date])->with('responsible')->indexBy('id')->all();
        $totalTasks = count($tasks);
        Console::startProgress(0, $totalTasks);
        $i = 1;
        foreach ($tasks as $task) {
            Yii::$app->mailer->compose()
                ->setFrom('noreply@mail.com')
                ->setTo($task->responsible->email)
                ->setSubject("Уведомление о дедлайне задачи №{$task->id}")
                ->setTextBody("До окончания срока выполнения задачи №{$task->id} '{$task->name}' осталось меньше 24 часов")
                ->send();
            Console::updateProgress($i++, $totalTasks);
        }
        Console::endProgress();
        echo 'EMAIL NOTIFICATIONS SENT SUCCESSFULLY';

    }

}