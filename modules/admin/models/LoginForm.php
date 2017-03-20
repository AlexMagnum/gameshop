<?php
namespace app\modules\admin\models;

use app\models\Users;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $salt = "stev37f";
    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'message' => 'Не заполнено поле'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params)
    {

        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !(md5($this->password.$this->salt) === $user->password)) {
                $this->addError($attribute, "Пароль или имя пользователя введены неверно");
            }
        }

    }

    public function getUser()
    {
        return Users::findOne(['name' => $this->username]);
    }
}