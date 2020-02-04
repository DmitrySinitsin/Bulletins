<?php

namespace app\models;

use yii\base\Model;

class AdvsearchForm extends Model {
    
    public $date_pub_n;
    public $date_pub_o;
    
    public $title, $info, $city, $contacts, $radio_, $pills_;
    
    public $price, $price_from, $price_to, $price_more;
    
    public function rules(){
        return [
            [['date_pub_n','date_pub_o'],'string','message'=>'В поле должна быть введена строка'],
            [['title','info','city','contacts','radio_','pills_'],'string','message'=>'В поле должен быть введен текст'],
            [['price','price_from','price_to','price_more'],'double','message'=>'В поле должно быть введено числовое значение'],
        ];
    }
    
}

