<?php
namespace  app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\Games;
use app\models\Gamemedia;

class TopSales extends Widget{

    public function  run(){

        $games = Games::find()->where(['>', 'in_stock', 0])->orderBy(['sale_count' => SORT_DESC])->limit(3)->all();

        $str = "";
        foreach ($games as $game){
            $game_img = Gamemedia::find()->where(['game_id' => $game->id])->one();
            $img3div = Html::tag('img', null, ['src' => $game_img->img_main, 'alt' => $game->name]);
            $img3div .= Html::tag('div', Html::encode($game->name), ['class' => 'description']);
            if($game->discount > 0) {
                $img3div .= Html::tag('div', '-' . Html::encode($game->discount) . '%', ['class' => 'rbdiscount']);
            }
            $img3div .= Html::tag('div', Html::encode($game->price).' грн', ['class' => 'rbprice']);
            $divminfoot = Html::tag('div', $img3div , ['class' => 'minfoot']);
            $aref = Html::tag('a', $divminfoot, ['href' => $game->link]);
            $divbar = Html::tag('div', $aref, ['class' => 'bar']);
            $str .= $divbar;
        }
        return $str;
    }
}

?>