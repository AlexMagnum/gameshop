<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_sysmac".
 *
 * @property integer $id
 * @property string $os
 * @property string $cpu
 * @property string $ram
 * @property string $videocard
 * @property string $hdd
 * @property integer $game_id
 *
 * @property Games $game
 */
class Sysmac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_sysmac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id'], 'required'],
            [['game_id'], 'integer'],
            [['os', 'cpu', 'ram', 'videocard', 'hdd'], 'string', 'max' => 255],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'os' => 'Версии операционной системы',
            'cpu' => 'Процессор',
            'ram' => 'Оперативная память',
            'videocard' => 'Видеокарта',
            'hdd' => 'Жесткий диск',
            'game_id' => 'Game ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Games::className(), ['id' => 'game_id']);
    }
}
