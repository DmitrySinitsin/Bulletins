<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class UserForm extends Model
{
    public $username;
    public $password;
    public $confirmPassword;
    public $surname;
    public $name;
    public $middlename;
    
    public function rules() {
        return [
            [['username','password','confirmPassword',
                'surname','name','middlename'],'required','message'=>'Поле не должно быть пустым'],
            [['username','password','confirmPassword',
                'surname','name','middlename'],'string'],
            ['confirmPassword','compare','compareAttribute'=>'password','message'=>'Поля "Пароль"'
                .'и "Подтверждение пароля" должны совпадать'],
        ];
    }
    public function attributeLabels() {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'confirmPassword' => 'Подтвердить пароль',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'middlename' => 'Отчество',
        ];
    }
}