<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bulletins".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $date_pub
 * @property string|null $title
 * @property string|null $info
 * @property string|null $contacts
 * @property string|null $city
 * @property float|null $price
 * @property string|null $status
 */
class BulletinsRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bulletins';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id','avatar'], 'integer'],
            [['date_pub'], 'safe'],
            [['price'], 'number'],
            [['title', 'info', 'contacts', 'city', 'status'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'date_pub' => 'Date Pub',
            'title' => 'Title',
            'info' => 'Info',
            'contacts' => 'Contacts',
            'city' => 'City',
            'price' => 'Price',
            'status' => 'Status',
            'avatar' => 'Avatar',
        ];
    }
    
    public function getPhoto()
    {
        return $this->hasMany(PhotoRecord::classname(), ['bull_id'=>'id']);
    }

    public function getThemesbulletins()
    {
        return $this->hasMany(ThemesbulletinsRecord::className(), ['bulletins_id' => 'id']);
    }

    public function setNewRecord($bull, $session_id)
    {
        $this->user_id= $session_id;
        $this->title=   $bull->title;
        $this->info=    nl2br($bull->info);
        $this->contacts=$bull->contacts;
        $this->city=    $bull->city;
        $this->price=   $bull->price;
        $this->status= 'wait';
    }
    
    public function setPublic()
    {
        $this->date_pub = date('Y-m-d H:i:s');
        $this->status = 'public';
    }
    
    public function setDelete()
    {
        $this->status = 'delete';
    }
    
    public function setWait()
    {
        $this->status = 'wait';
    }
    public function getAvatar()
    {
        $photoRec=PhotoRecord::find()
                ->where(['id'=> $this->avatar])
                ->one();
        if(isset($photoRec))
            return $photoRec->link;
        else
            return Yii::$app->params['imagePath'].Yii::$app->params['defaultImage'];
    }
            
}
