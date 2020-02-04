<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\BulletinsRecord;
use app\models\PhotoForm;
use app\models\PhotoRecord;
use yii\web\UploadedFile;

class PhotoController extends Controller 
{
    public function behaviors() : array {
        return[
            'access'=>[
                'class'=> AccessControl::className(),
                'only'=>['index','add','setinfo','getinfo','setavatar','setdelete'],
                'rules'=>[
                    [
                        'actions'=>['index','add','setinfo','getinfo','setavatar','setdelete'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex($id=1)
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect ('/site/login');
        $currBulletin = BulletinsRecord::find()
                ->where(['id'=>$id])
                ->one();
        return $this->render('index',['currBulletin'=>$currBulletin]);
    }
    public function actionAdd($id=1)
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect ('/site/login');
        $Photo = new PhotoForm();
        if(Yii::$app->request->isPost)
        {
            if($Photo->validate())
            {  
                    $Photo->upload();
                    $PhotoRec = new PhotoRecord();
                    $PhotoRec->link = $Photo->link;
                    $PhotoRec->bull_id = $id;
                    $PhotoRec->save(); 
                return $this->redirect ('/photo/index?id='.$id);
            }
        }
        return $this->render('add',['photo'=>$Photo]);
    }
    
    
    public function actionSetinfo()//добавление info в базу
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect ('/site/login');
        if(Yii::$app->request->isAjax)
        {
        
            $this_id    = $_POST['id'];
            $this_info  = $_POST['info'];
            $photoRecord = PhotoRecord::find()
                    ->where(['id'=>$this_id])
                    ->one();
            $photoRecord->info = $this_info;
            $photoRecord->save();
            return "Запрос выполнен id=".$this_id." info: ".$this_info;
        }
    }
    
    public function actionGetinfo()//получение info из базы
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect ('/site/login');
        if(Yii::$app->request->isAjax)
        {
            //data: {id:r, info:info_},
            $this_id    = $_POST['id'];
            
            $photoRecord = PhotoRecord::find()
                    ->where(['id'=>$this_id])
                    ->one();
            $this_info = $photoRecord->info;
            //$photoRecord->save();
            return $this_info;
        }
    }
    public function actionSetavatar()
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect ('/site/login');
        if(Yii::$app->request->isAjax)
        {
            $photo_id=$_POST['PhotoId'];
            $bull_id=$_POST['BullId'];
            
            $bullRec= BulletinsRecord::find()
                    ->where(['id'=>$bull_id])
                    ->one();
            $bullRec->avatar = $photo_id;
            $bullRec->save();
            return "Изображение установлено в качестве главного";
        }
    }
    public function actionSetdelete()
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect ('/site/login');
        
        if(Yii::$app->request->isAjax) {
            $photo_id=$_POST['id'];
            
            $photoRec= PhotoRecord::findOne($photo_id);
            $photoRec->deleteFile();
            $photoRec->delete();
            return 'Изображение удалено';
        }
    }
}














