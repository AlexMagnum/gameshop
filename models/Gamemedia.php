<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\base\Model;

class Gamemedia extends ActiveRecord
{
    public $link;
    public $img_main;

    public  function afterFind()
    {
        $this->img_main = "../../web/img/game/".preg_replace("/[^a-zA-ZА-Яа-я0-9\s-]/","",$this->game->meta_title)."/poster/".$this->poster_img;
    }

    public function rules()
    {
        return [
            [['poster_img', 'video_trailer', 'game_id'], 'required', 'message' => 'Не заполнено поле'],
            [['game_id'], 'integer'],
            [['poster_img', 'video_trailer'], 'string', 'max' => 255],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }
    
    public function getGame(){
        return $this->hasOne(Games::className(), ['id' => 'game_id']);
    }

}
