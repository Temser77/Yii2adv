<?php

namespace common\models\tables;



/**
 * This is the model class for table "statuses".
 *
 * @property int $id
 * @property string $status
 * @property array $statusesList
 */
class Statuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => \Yii::t('app', 'status'),
        ];
    }
    public static function getStatusesList() {
        return self::find()
            ->select(['status'])
            ->indexBy('id')
            ->column();
    }
}
