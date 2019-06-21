<?php

namespace common\models\tables;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $description
 * @property int $task_id
 * @property int $creator_id
 * @property string $created
 * @property UploadedFile $uploaded_file
 *
 * @property Tasks $task
 * @property Users $creator
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'task_id', 'creator_id'], 'required'],
            [['task_id', 'creator_id'], 'integer'],
            [['created'], 'safe'],
            [['description', 'uploaded_file'], 'string', 'max' => 255],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::class, 'targetAttribute' => ['task_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'comments_id'),
            'description' => Yii::t('app', 'comments_description'),
            'task_id' => Yii::t('app', 'comments_task_id'),
            'creator_id' => Yii::t('app', 'comments_creator_id'),
            'created' => Yii::t('app', 'comments_created'),
            'uploaded_file' => 'Uploaded File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Users::className(), ['id' => 'creator_id']);
    }
}
