<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "themes".
 *
 * @property int $id
 * @property int|null $parental_id
 * @property string|null $title
 * @property string|null $info
 *
 * @property Themesbulletins[] $themesbulletins
 */
class ThemesRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'themes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parental_id'], 'integer'],
            [['info'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parental_id' => 'Parental ID',
            'title' => 'Title',
            'info' => 'Info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThemesbulletins()
    {
        return $this->hasMany(ThemesbulletinsRecord::className(), ['themes_id' => 'id']);
    }
    
    public function getThemesBullCount()
    {
        //return $this->getThemesbulletins()->count();
        return count($this->getBullCurrTheme());
    }
    public function getBullCurrTheme()
    {
        $bull=array();
        $themesbulletins= $this->themesbulletins;
        foreach ($themesbulletins as $tb)
            if($tb->bulletins->status=='public')
                array_push($bull, $tb->bulletins);
        return $bull;
    }
    public function setDeleteThemesBullRecord()
    {
        $themesbulletins= $this->themesbulletins;
        foreach ($themesbulletins as $thb)
            $thb->delete();
    }
    
    public function setNewRecord($form){
        $this->title= $form->title;
        $this->info=  $form->info;
        if($form->parental_id>0)
            $this->parental_id= $form->parental_id;
    }
}
