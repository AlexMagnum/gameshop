<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Buy extends Model
{
    public $email;
    public $accept;

    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'Не заполнено поле'],
            ['email', 'email', 'message' => 'Некорректный e-mail адрес'],
            ['accept', 'required', 'requiredValue' => 1, 'message' => 'Требуется подтверждение']
        ];
    }
}