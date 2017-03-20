<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "gs_users".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $salt = "stev37f";

    public static function tableName()
    {
        return 'gs_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'role'], 'required', 'message' => 'Не заполнено поле'],
            ['email', 'email', 'message' => 'Не действительный адрес электронной почты'],
            [['name', 'password', 'role'], 'string', 'max' => 50],
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    public function setPassword($password){
        $this->password = md5($password.$this->salt);
    }

    public function setRole($name , $user_id){
        $auth = Yii::$app->authManager;

        if($name == 'Админ') {
            $role = $auth->getRole('admin');
            $auth->assign($role, $user_id);
        } else if($name == 'Редактор'){
            $role = $auth->getRole('redactor');
            $auth->assign($role, $user_id);
        } else if($name == 'Поддержка'){
            $role = $auth->getRole('support');
            $auth->assign($role, $user_id);
        }
    }

    public function updateRole($name , $user_id){
        $auth = Yii::$app->authManager;
        $auth->revokeAll($user_id);

        if($name == 'Админ') {
            $role = $auth->getRole('admin');
            $auth->assign($role, $user_id);
        } else if($name == 'Редактор'){
            $role = $auth->getRole('redactor');
            $auth->assign($role, $user_id);
        } else if($name == 'Поддержка'){
            $role = $auth->getRole('support');
            $auth->assign($role, $user_id);
        }
    }

    public function deleteRole($user_id){
        $auth = Yii::$app->authManager;
        $auth->revokeAll($user_id);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'role' => 'Права',
        ];
    }
}
