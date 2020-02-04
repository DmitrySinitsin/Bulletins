<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userinfo".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $surname
 * @property string|null $name
 * @property string|null $middlename
 */
class UserinfoRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userinfo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['surname', 'name', 'middlename'], 'string', 'max' => 255],
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
            'surname' => 'Surname',
            'name' => 'Name',
            'middlename' => 'Middlename',
        ];
    }
    
    public function createUserInfo($newUser, $userid)
    {
       $this->user_id = $userid;
       $this->surname = $newUser->surname;
       $this->name = $newUser->name;
       $this->middlename = $newUser->middlename;
    }
}
