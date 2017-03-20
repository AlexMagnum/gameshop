<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_osgame".
 *
 * @property integer $fk_game_id
 * @property integer $fk_os_id
 * @property integer $id
 *
 * @property Games $fkGame
 * @property Os $fkOs
 */
class Osgame extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_osgame';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_game_id', 'fk_os_id'], 'required', 'message' => 'Не выбрана операционная система(ы) игры'],
            [['fk_game_id', 'fk_os_id'], 'integer'],
            [['fk_game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['fk_game_id' => 'id']],
            [['fk_os_id'], 'exist', 'skipOnError' => true, 'targetClass' => Os::className(), 'targetAttribute' => ['fk_os_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fk_game_id' => 'Fk Game ID',
            'fk_os_id' => 'Fk Os ID',
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
    public function getFkOs()
    {
        return $this->hasOne(Os::className(), ['id' => 'fk_os_id']);
    }
}
