<?php
namespace app\models;
use Yii;
class PhotoRecord extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'photo';
    }
    public function rules()
    {
        return [
            [['bull_id'], 'required'],
            [['bull_id'], 'integer'],
            [['link', 'info'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bull_id' => 'Bull ID',
            'link' => 'Link',
            'info' => 'Info',
        ];
    }
    public function deleteFile()
    {
        $file_= $this->link;
        unlink($file_);
    }
}
