<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $body;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'email', 'body'], 'required', 'message' => 'Не заполнено поле'],
            ['email', 'email', 'message' => 'Некорректный e-mail адрес'],
            ['verifyCode', 'captcha', 'message' => 'Неправильный код подтверждения'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
}
