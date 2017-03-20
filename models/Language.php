<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_language".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Gamelanguage[] $gamelanguages
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_language';
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
    public function getGamelanguages()
    {
        return $this->hasMany(Gamelanguage::className(), ['fk_language_id' => 'id']);
    }
}
