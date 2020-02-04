<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\UserRecord;
use app\models\UserinfoRecord;
use app\models\UserForm;

class UserController extends Controller
{
    public function actionIndex() {
        
        $currSession = Yii::$app->session;
        $currUser = UserRecord::getCurrUser($currSession['__id']);
               
        return $this->render('index',['currUser'=>$currUser]);
    }
    
    public function actionAdd()
    {
        $newUser = new UserForm();
        if($newUser->load(Yii::$app->request->post()) )
        {
            if($newUser->validate())
            {
                $newUserRec= new UserRecord();
                $newUserRec->createUser($newUser);
                $newUserRec->save();
                
                $newUserInfoRec = new UserinfoRecord();
                $newUserInfoRec->createUserInfo($newUser, $newUserRec->id);
                $newUserInfoRec->save();
                
                $this->redirect("/site/login");
            }
        }
        return ($this->render('adduser', ['newUser'=>$newUser]));
    }
}
