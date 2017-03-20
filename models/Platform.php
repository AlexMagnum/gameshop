<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Platform extends ActiveRecord
{
    public $link;
    
    public  function afterFind()
    {
        $this->link = Yii::$app->urlManager->createUrl(["site/platform",  "id" => $this->platform_id]);
    }

    public function getGames(){
        return $this->hasMany(Games::className(), ['id' => 'fk_game_id'])
            ->viaTable('gs_gameplatform', ['fk_platform_id' => 'platform_id']);
    }
}