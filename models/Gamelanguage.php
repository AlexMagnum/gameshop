<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_gamelanguage".
 *
 * @property integer $fk_game_id
 * @property integer $fk_language_id
 * @property integer $id
 *
 * @property Games $fkGame
 * @property Language $fkLanguage
 */
class Gamelanguage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_gamelanguage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_game_id', 'fk_language_id'], 'required', 'message' => 'Не выбран язык(и) игры'],
            [['fk_game_id', 'fk_language_id'], 'integer'],
            [['fk_game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['fk_game_id' => 'id']],
            [['fk_language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['fk_language_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fk_game_id' => 'Fk Game ID',
            'fk_language_id' => 'Fk Language ID',
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
    public function getFkLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'fk_language_id']);
    }
}
