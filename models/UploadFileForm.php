<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFileForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($game)
    {
        if ($this->validate()) {
            $dir = "../web/img/game/".preg_replace("/[^a-zA-ZА-Яа-я0-9\s-]/","",$game)."/poster/";
            if(!is_dir($dir)) mkdir($dir,0777,true);
            $this->imageFile->saveAs( "../web/img/game/".preg_replace("/[^a-zA-ZА-Яа-я0-9\s-]/","",$game)."/poster/" . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}