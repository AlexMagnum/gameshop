<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_os".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Osgame[] $osgames
 */
class Os extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_os';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsgames()
    {
        return $this->hasMany(Osgame::className(), ['fk_os_id' => 'id']);
    }
}
