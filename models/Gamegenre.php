<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_gamegenre".
 *
 * @property integer $fk_game_id
 * @property integer $fk_genre_id
 * @property integer $id
 *
 * @property Games $fkGame
 * @property Genre $fkGenre
 */
class Gamegenre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_gamegenre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_game_id', 'fk_genre_id'], 'required', 'message' => 'Не выбран жанр(ы) игры'],
            [['fk_game_id', 'fk_genre_id'], 'integer'],
            [['fk_game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['fk_game_id' => 'id']],
            [['fk_genre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genre::className(), 'targetAttribute' => ['fk_genre_id' => 'genre_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fk_game_id' => 'Fk Game ID',
            'fk_genre_id' => 'Fk Genre ID',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkGame()
    {
        return $this->hasOne(Games::className(), ['id' => 'fk_game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkGenre()
    {
        return $this->hasOne(Genre::className(), ['genre_id' => 'fk_genre_id']);
    }
}
