<?php
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
    * @var UploadedFile
    */
    public $xlsFile;

    public function rules()
    {
        return [
            [['xlsFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx',],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->xlsFile->saveAs('uploads/' . $this->xlsFile->baseName . '.' . $this->xlsFile->extension);
            return true;
        }
        else {
            return false;
        }
    }
}