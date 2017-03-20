<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Games extends ActiveRecord
{
    public $link;
    public $date_releaseformat;
    
    public  function afterFind()
    {
        $monthes  = [
            1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
            5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
            9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
        ];

       $this->date_releaseformat = date('j', strtotime($this->date_release)).' '.$monthes[date('n',
                strtotime($this->date_release))].' '.date(' Y', strtotime($this->date_release));
       $this->link = Yii::$app->urlManager->createUrl(["site/game", "id" => $this->id]);
    }

    public function rules()
    {
        return [
            [['name', 'price', 'discount', 'last_sale', 'sale_count', 'is_release',
                'meta_title', 'date_release', 'meta_desc', 'meta_key', 'publisher',
                'in_stock', 'full_text'], 'required', 'message' => 'Не заполнено поле'],
            [['price'], 'number'],
            [['discount', 'sale_count', 'is_release', 'in_stock'], 'integer'],
            [['last_sale', 'date_release'], 'safe'],
            [['full_text'], 'string'],
            [['name', 'meta_title', 'meta_desc', 'meta_key', 'publisher'], 'string', 'max' => 255],
        ];
    }

    public function getPlatform(){
        return $this->hasMany(Platform::className(), ['platform_id' => 'fk_platform_id'])
            ->viaTable('gs_gameplatform', ['fk_game_id' => 'id']);
    }

    public function getGenre(){
        return $this->hasMany(Genre::className(), ['genre_id' => 'fk_genre_id'])
            ->viaTable('gs_gamegenre', ['fk_game_id' => 'id']);
    }

    public function getOs(){
        return $this->hasMany(Os::className(), ['id' => 'fk_os_id'])
            ->viaTable('gs_osgame', ['fk_game_id' => 'id']);
    }

    public function getLanguage(){
        return $this->hasMany(Language::className(), ['id' => 'fk_language_id'])
            ->viaTable('gs_gamelanguage', ['fk_game_id' => 'id']);
    }

    public function getMode(){
        return $this->hasMany(Mode::className(), ['id' => 'fk_mode_id'])
            ->viaTable('gs_gamemode', ['fk_game_id' => 'id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'price' => 'Цена',
            'discount' => 'Скидка',
            'last_sale' => 'Последняя продажа',
            'sale_count' => 'Количество продаж',
            'is_release' => 'Предзаказ',
            'meta_title' => 'Заголовок',
            'date_release' => 'Дата выхода',
            'meta_desc' => 'Мета описание',
            'meta_key' => 'Ключевые слова',
            'publisher' => 'Издатель',
            'in_stock' => 'На складе',
            'full_text' => 'Описание',
        ];
    }
}

