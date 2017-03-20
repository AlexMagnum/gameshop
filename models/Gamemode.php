<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_gamemode".
 *
 * @property integer $fk_game_id
 * @property integer $fk_mode_id
 * @property integer $id
 *
 * @property Games $fkGame
 * @property Mode $fkMode
 */
class Gamemode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_gamemode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_game_id', 'fk_mode_id'], 'required', 'message' => 'Не выбран режим(ы) игры'],
            [['fk_game_id', 'fk_mode_id'], 'integer'],
            [['fk_game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['fk_game_id' => 'id']],
            [['fk_mode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mode::className(), 'targetAttribute' => ['fk_mode_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fk_game_id' => 'Fk Game ID',
            'fk_mode_id' => 'Fk Mode ID',
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
    public function getFkMode()
    {
        return $this->hasOne(Mode::className(), ['id' => 'fk_mode_id']);
    }
}
