<?php

namespace app\models;
use \yii\base\Model;

class BulletinsForm extends Model
{
    public $title;
    public $info;
    public $contacts;
    public $city;
    public $price;
    
    public function rules() 
    {
        return
        [
            [[  'title',
                'info',
                'contacts',
                'city',
                'price'],
                'required','message'=>'Поле не должно быть пустым'
            ],
            
            [[  'title',
                'info',
                'contacts',
                'city',
                ],
                'string',
            ],
            ['price','double']
        ]
        ;
    }
    
    public function attributeLabels()
    {
        return [
            
            'title' => 'Заголовок',
            'info' => 'Информация',
            'contacts' => 'Контакты',
            'city' => 'Город',
            'price' => 'Цена',
            
        ];
    }
    
    public function setCurrForm($record)
    {
        $this->title = $record->title;
        $this->info = $record->info;
        $this->contacts = $record->contacts;
        $this->city = $record->city;
        $this->price = $record->price;
    }
}