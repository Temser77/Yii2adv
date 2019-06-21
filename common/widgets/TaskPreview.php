<?php
namespace common\widgets;

use yii\base\Widget;
use common\models\tables\Tasks;

class TaskPreview extends Widget {
    public $model;
    public function run() {
        try {
            if (is_a($this->model, Tasks::class)) {
                return $this->render('task', [
                    'model' => $this->model
                ]);
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
        return null;
    }
}