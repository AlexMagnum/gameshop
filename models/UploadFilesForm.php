<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFilesForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 0],
        ];
    }

    public function upload($game)
    {

        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs( "../web/img/game/".preg_replace("/[^a-zA-ZА-Яа-я0-9\s-]/","",$game)."/". $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}