<?php
namespace  app\components;

use Yii;
use Faker\Provider\DateTime;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Games;
use app\models\Gamemedia;

class LastBuy extends Widget{


    public function  run(){
        $games = Games::find()->orderBy(['last_sale' => SORT_DESC])->limit(4)->all();
        $str = "";

        foreach ($games as $game){
            $game_img = Gamemedia::find()->where(['game_id' => $game->id])->one();
            $time = date("Y-m-d H:i:s",strtotime($game->last_sale));
            $today = time();
            $min = (($today - strtotime($time)) / 60);
            if ($min == 0)
                $min = 1;
            $img = Html::tag('img', null, ['src' => $game_img->img_main, 'alt' => $game->name]);
            $divimg = Html::tag('div', $img, ['class' => 'imggame']);
            $div2 = Html::tag('div', ceil($min).' мин назад', ['class' => 'time']);
            $div2 .= $divimg;
            $aref = Html::tag('a', $div2, ['href' => $game->link]);
            $divlastsales = Html::tag('div', $aref, ['class' => 'lastsales']);
            $str .= $divlastsales;
        }
        return $str;
    }
}

?>

