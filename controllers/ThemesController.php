<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\ThemesRecord;
use app\models\ThemesForm;

class ThemesController extends Controller {

    public function actionIndex() {
        if (Yii::$app->user->isGuest)
            return $this->redirect('/site/login');
        $themes = ThemesRecord::find()
                ->all();
        return $this->render('index', ['themes' => $themes]);
    }

    public function actionDeletequery($id = 0) {
        if (Yii::$app->user->isGuest)
            return $this->redirect('/site/login');
        $prev_url = \Yii::$app->request->referrer;
        
        if($id<=0)
        {
            $this->redirect('/themes/index');
        }
        
        if ($id>0)
        {
            $theme = ThemesRecord::find()
                    ->where(['id'=>$id])
                    ->one();
            return $this->render('deletequery',['theme'=>$theme, 'prev_url'=>$prev_url]);
        }
    }

    public function actionDelete($id=0){
        if (Yii::$app->user->isGuest)
            return $this->redirect('/site/login');
        if($id>0)
        {
            $theme=ThemesRecord::findOne($id);
            $theme->setDeleteThemesBullRecord();
            $theme->delete();
            return $this->redirect('/themes/index');
        }
    }
    public function actionAdd($id=0) {
        $currForm= new ThemesForm();
        
        if($id>0)
        {
            $newRecord= ThemesRecord::find()
                    ->where(['id'=>$id])
                    ->one();
            $currForm->setNewForm($newRecord);
        }
        
        if($currForm->load(Yii::$app->request->post()))
        {
            if($currForm->validate())
            {
                if($id>0)
                    $newRecord= ThemesRecord::find()
                        ->where(['id'=>$id])
                        ->one();
                else
                    $newRecord=new ThemesRecord();
                
                $newRecord->setNewRecord($currForm);
                $newRecord->save();
                $this->redirect('/themes/index');
            }
        }
        $prev_url = \Yii::$app->request->referrer;
        return $this->render('add',['currTheme'=>$currForm,'prev_url'=>$prev_url]);
    }
}
