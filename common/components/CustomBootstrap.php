<?php
/**
 * Created by PhpStorm.
 * User: post.user14
 * Date: 27.05.2019
 * Time: 12:10
 */

namespace common\components;


use common\models\tables\Tasks;
use yii\base\Component;
use yii\base\Event;
use Yii;

class CustomBootstrap extends Component
{
    public function init()
    {
        parent::init();
        $this->startEventHandlers();
        $this->changeAppLanguage();
    }

    private function changeAppLanguage() {
        if ($language = Yii::$app->session->get('language')) {
            Yii::$app->language = $language;
        }
    }

    private function startEventHandlers() {
        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function ($event) {
            $task = $event->sender;
            $message = Yii::$app->mailer->compose('emailNotification', ['task' => $task]);
            if (Yii::$app->user->isGuest) {
                $message->setFrom('from@domain.com');
            } else {
                $message->setFrom($task->creator->email);
            }
            $message->setTo($task->responsible->email)
                ->setSubject('Вам поступила новая задача ' . $task->name)
                ->send();
        });
    }


}