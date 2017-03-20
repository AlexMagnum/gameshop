<?php
namespace app\models;

use Yii;
use yii\base\Model;

class AdvancedSearchForm extends Model{
    public $game;
    public $publisher;
    public $genre;
    public $platform;
    public $price_from;
    public $price_to;
    public $order;

    public function rules(){
        return [
            [['publisher', 'game', 'genre', 'platform', 'order'], 'string'],
            [['price_from', 'price_to'], 'double']
        ];
    }
}