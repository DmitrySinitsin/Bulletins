<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\BulletinsForm;
use app\models\BulletinsRecord;
use app\models\ThemesbulletinsForm;
use app\models\ThemesbulletinsRecord;

class BulletinsController extends Controller 
{
    public function behaviors() : array {
        return[
            'access'=>[
                'class'=> AccessControl::className(),
                'only'=>['index','addbulletin','public','delete','wait','addtheme','deletetheme'],
                'rules'=>[
                    [
                        'actions'=>['index','addbulletin','public','delete','wait','addtheme','deletetheme'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        //if(Yii::$app->user->isGuest)
            //return $this->redirect ('/site/login');
        
        $currSession = Yii::$app->session;
        
        $wait_bulletins=    $this->getBulletins('wait');
        
        $public_bulletins=  $this->getBulletins('public');
        
        $delete_bulletins=  $this->getBulletins('delete');
        
        return $this->render('index',['wait_bulletins'=>$wait_bulletins,
                                      'public_bulletins'=>$public_bulletins,
                                      'delete_bulletins'=>$delete_bulletins]);
    }
    
    private function getBulletins($status='wait')
    {
        $currSession = Yii::$app->session;
        $bulletins=BulletinsRecord::find()
                ->where(['user_id'=>$currSession['__id']])
                ->andWhere(['status'=>$status])
                ->all();
        return $bulletins;
    }


    public function actionAddbulletin($id=-1)
    {
        //if(Yii::$app->user->isGuest)
            //return $this->redirect ('/site/login');
        $currSession = Yii::$app->session;
        $new_bull = new BulletinsForm();
        if($id>0)
        {
            $currRecord=BulletinsRecord::find()
                ->where(['id'=>$id])
                ->one();
            
            $new_bull->setCurrForm($currRecord);
        }
        if($new_bull->load(Yii::$app->request->post()))
            if($new_bull->validate())
            {
                if($id>0)
                {
                   $newRecord=BulletinsRecord::find()
                        ->where(['id'=>$id])
                        ->one(); 
                }
                else {
                    $newRecord= new BulletinsRecord();
                }
                
                $newRecord->setNewRecord($new_bull,$currSession['__id']);
                $newRecord->save();
                
                return $this->redirect('/bulletins/index');
            }
        return $this->render('add', ['model'=>$new_bull]);
    }
    
    public function actionPublic($id=1)
    {
        $this->setStatus($id, 'public');
    }
    
    public function actionDelete($id=1)
    {
        $this->setStatus($id, 'delete');
    }
    
    public function actionWait($id=1)
    {
        $this->setStatus($id);
    }
    
    private function setStatus($id=1,$status='wait')
    {
        $currBulletin = BulletinsRecord::find()
                ->where(['id'=>$id])
                ->one();
        if($status=='public')
            $currBulletin->setPublic();
        elseif($status=='delete')
            $currBulletin->setDelete();
        elseif($status=='wait')
            $currBulletin->setWait();
        $currBulletin->save();
        $this->redirect('/bulletins/index');
    }
    public function actionAddtheme($id=1){
        $currBulletin = BulletinsRecord::find()
                ->where(['id'=>$id])
                ->one();
        
        $model = new ThemesbulletinsForm();
        $model->bulletins_id = $currBulletin->id;
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $record= new ThemesbulletinsRecord();
                $record->bulletins_id=$currBulletin->id;
                $record->themes_id=$model->themes_id;
                $record->save();
            }
        }
        return $this->render('addtheme',['currBulletin'=>$currBulletin,'model'=>$model]);
    }
    public function actionDeletetheme($id=1){
        $currTb= Themesbulletinsrecord::find()
                ->where(['id'=>$id])
                ->one();
        $prev_bull_id= $currTb->bulletins_id;
        $currTb->delete();
        return $this->redirect('/bulletins/addtheme?id='.$prev_bull_id);
    }
}