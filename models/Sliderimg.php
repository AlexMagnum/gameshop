<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Sliderimg extends ActiveRecord
{
    public $link;

    public  function afterFind()
    {
        $this->img = "../../web/img/game/".preg_replace("/[^a-zA-ZА-Яа-я0-9\s-]/","",$this->game->meta_title)."/".$this->img;

    }

    public function rules()
    {
        return [
            [['img', 'game_id'], 'required'],
            [['game_id'], 'integer'],
            [['img'], 'string', 'max' => 255],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    public function getGame(){
        return $this->hasOne(Games::className(), ['id' => 'game_id']);
    }
}
