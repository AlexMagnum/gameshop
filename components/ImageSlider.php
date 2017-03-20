<?php
namespace  app\components;

use Yii;
use Faker\Provider\DateTime;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Games;
use app\models\Gamemedia;

class ImageSlider extends Widget{

    public $sortvalue;
    public $method;

    public function run(){
        $games = Games::find()->where(['>', 'in_stock', 0])->orderBy([$this->sortvalue => $this->method])->limit(5)->all();
        $str = "";

        foreach ($games as $game){
            $game_img = Gamemedia::find()->where(['game_id' => $game->id])->one();
            $curr = Html::tag('i', null, ['class' => 'curr']);
            $imggame = Html::tag('img', null, ['src' => $game_img->img_main, 'alt' => $game->name]);

            if($game->discount > 0) {
                $divprice = Html::tag('div', $game->price.$curr, ['class' => 'price']);
                $divdisc = Html::tag('div', '-' . $game->discount . '%', ['class' => 'discount']);
                $divwrap = Html::tag('a', $imggame.$divprice.$divdisc, ['href' => $game->link]);
            } else{
                $divprice = Html::tag('div', $game->price.$curr, ['class' => 'pricewithoutdisc']);
                $divwrap = Html::tag('a', $imggame.$divprice, ['href' => $game->link]);
            }

            $str .= Html::tag('li', $divwrap);
        }
        return Html::tag('ul', $str, ['class' => 'rslides']);
    }
}

?>
