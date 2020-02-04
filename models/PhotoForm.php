<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PhotoForm extends Model {

    public $file;
    public $link;
    public $info;

    public function rules() 
    {
        return [
            [['file'],'file','extensions'=>'jpg,png','message'=>'Фото должно быть формата jpg или png',
                'skipOnEmpty'=>'false'],
            [['link','info'],'string'],
            
        ];
        
    }
    
    public function attributeLabels()
    {
        return [
            'file' => 'Загрузить изображение',
            'link' => 'Ссылка',
            'info' => 'Информация',
        ];
    }
    
    public function upload()
    {
        
        $this->file= UploadedFile::getInstance($this, 'file');
        $this->file ->saveAs(Yii::$app->params['imagePath'].''.$this->file->baseName.'_'.time().'.'.$this->file->extension);
        $this->link = Yii::$app->params['imagePath'].''.$this->file->baseName.'_'.time().'.'.$this->file->extension;
    }
}
