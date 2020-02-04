<?php

namespace app\models;
use Yii;
use yii\base\Model;
use app\models\ThemesRecord;

class ThemesForm extends Model
{
    public $title;
    public $info;
    public $parental_id;
    
    public function rules() {
        return [
            [['parental_id'],'integer'],
            [['title','info'],'string'],
            [['title'],'required','message'=>'Поле не должно быть пустым'],
            
        ];
    }
    public function attributeLabels(){
        return[
            'parental_id'=>'Родительская тема',
            'title'=>'Тема',
            'info'=>'Информация',
        ];
    }
    public function setNewForm($record){
        $this->parental_id= $record->parental_id;
        $this->title= $record->title;
        $this->info= $record->info;
    }
    public function parent_themes_find(){
        $parent_themes= ThemesRecord::find()->all();
        return $parent_themes;
    }
}