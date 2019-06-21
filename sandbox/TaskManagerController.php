<?php

namespace app\controllers;

use app\models\tables\Comments;
use app\models\tables\Statuses;
use app\models\UploadedCommentImage;
use Yii;
use app\models\tables\Users;
use app\models\User;
use app\models\tables\Tasks;
use app\models\filters\TasksFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Event;
use yii\web\UploadedFile;

/**
 * TaskManagerController implements the CRUD actions for Tasks model.
 */
class TaskManagerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                //'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => false,
                        //'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        //'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksFilter();
        $usersList = ['' => "all"] + Users::getUsersList();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Формируем ключ для кэша вывода по месяцам
        $FilterCacheKey = null;
        if ($searchModel->load(Yii::$app->request->get()) && ($searchModel->created != null)) {
            $FilterCacheKey = 'FilterCreated' . $searchModel->created;
        }
        //

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'usersList' => $usersList,
            'FilterCacheKey' => $FilterCacheKey
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelComments = new Comments();

        if ($modelComments->load(Yii::$app->request->post())) {
            $modelUploadedFile = new UploadedCommentImage();
            if($modelUploadedFile->uploadCommentImg($modelComments, 'uploaded_file')) {
                $modelComments->uploaded_file = $modelUploadedFile->file->name;
            }
            if($modelUploadedFile->validate()) {
                $modelComments->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $query = Comments::find()->where(['task_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'created' => SORT_DESC,
                ]
            ]

        ]);

        return $this->render('viewone', [
            'model' => $model,
            'modelComments' => $modelComments,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['cannotcreate']);
        }
        $model = new Tasks();
        $usersList = Users::getUsersList();
        $statuses = Statuses::getStatusesList();
        $rights = $this->checkCreateRights();

        $authUser[] = Users::findOne(Yii::$app->user->id)->toArray(['id', 'username']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'usersList' => $usersList,
            'statuses' => $statuses,
            'rights' => $rights,
            'authUser' => $authUser
        ]);
    }

    public function actionCannotcreate()
    {
        return $this->render('cannotcreate');
    }


    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!isset(Yii::$app->user->identity->username)) {
            return $this->redirect(['cannotcreate']);
        }
        $model = $this->findModel($id);

        $usersList = Users::getUsersList();
        $statuses = Statuses::getStatusesList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $authUser[] = Users::findOne(['username' => Yii::$app->user->identity->username])->toArray(['id', 'username']);

        return $this->render('update', [
            'model' => $model,
            'usersList' => $usersList,
            'statuses' => $statuses,
            'rights' => true,
            'authUser' => $authUser
        ]);
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function checkCreateRights()
    {
        return Yii::$app->user->identity->username == 'admin';
    }
}
