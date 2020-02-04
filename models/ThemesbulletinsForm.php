<?php

namespace app\models;

use yii\base\Model;

class ThemesbulletinsForm extends Model {
    public $themes_id;
    public $bulletins_id;
    
    public function rules() {
        return
        [
            [['bulletins_id', 'themes_id'], 'integer'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bulletins_id' => 'ID объявления',
            'themes_id' => 'ID темы',
        ];
    }
    public function getListThemes($bulletins_id)
    {
        $tb= ThemesbulletinsRecord::find()
                ->select('themes_id as id')
                ->where(['bulletins_id'=>$bulletins_id])
                ->all();
        $themes= ThemesRecord::find()
                ->where(['not in','id',$tb])
                ->all();
        return $themes;
    }
}

