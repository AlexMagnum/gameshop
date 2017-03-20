<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_gameplatform".
 *
 * @property integer $fk_game_id
 * @property integer $fk_platform_id
 * @property integer $id
 *
 * @property Games $fkGame
 * @property Platform $fkPlatform
 */
class Gameplatform extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_gameplatform';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_game_id', 'fk_platform_id'], 'required', 'message' => 'Не выбрана платформа(ы) игры'],
            [['fk_game_id', 'fk_platform_id'], 'integer'],
            [['fk_game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['fk_game_id' => 'id']],
            [['fk_platform_id'], 'exist', 'skipOnError' => true, 'targetClass' => Platform::className(), 'targetAttribute' => ['fk_platform_id' => 'platform_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fk_game_id' => 'Fk Game ID',
            'fk_platform_id' => 'Fk Platform ID',
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
    public function getFkPlatform()
    {
        return $this->hasOne(Platform::className(), ['platform_id' => 'fk_platform_id']);
    }
}
