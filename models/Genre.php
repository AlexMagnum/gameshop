<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Genre extends ActiveRecord
{
    public $link;

    public  function afterFind()
    {
        $this->link = Yii::$app->urlManager->createUrl(["site/genre",  "id" => $this->genre_id]);
    }


    public function getGames(){
        return $this->hasMany(Games::className(), ['id' => 'fk_game_id'])
            ->viaTable('gs_gameplatform', ['fk_genre_id' => 'genre_id']);
    }
}