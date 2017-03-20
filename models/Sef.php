<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gs_sef".
 *
 * @property integer $id
 * @property string $link
 * @property string $link_sef
 */
class Sef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gs_sef';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'link_sef'], 'required', 'message' => 'Не заполнено поле'],
            [['link', 'link_sef'], 'string', 'max' => 255],
            [['link'], 'unique'],
            [['link_sef'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Фактическая ссылка',
            'link_sef' => 'ЧПУ ссылка',
        ];
    }
}
