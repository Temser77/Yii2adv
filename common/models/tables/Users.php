<?php

namespace common\models\tables;
use Yii;



/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property array $usersList
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app', 'users_username'),
            'password' => Yii::t('app', 'users_password'),
            'auth_key' => 'Authorization Key',
            'access_token' => 'Access Token',
        ];
    }

    public static function getUsersList() {
        return self::find()
            ->select(['username'])
            ->indexBy('id')
            ->column();
    }


}
