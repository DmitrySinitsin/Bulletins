<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\BulletinsRecord;
use app\models\ThemesRecord;
use app\models\AdvsearchForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    //public $password;
    //public $hash;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id=0)
    {
        if($id==0)
        {
            $bulletins = BulletinsRecord::find()
                ->where(['status'=>'public'])
                ->all();
        }
        else if($id>0)
        {
            $currTheme= ThemesRecord::find()
                    ->where(['id'=>$id])
                    ->one();
            $bulletins = $currTheme->getBullCurrTheme();
            Yii::$app->session->setFlash('info','Объявления по теме: <strong>'.$currTheme->title.'</strong>');
        }
            
        $themes = ThemesRecord::find()
                ->all();
        $imagePath= Yii::$app->params['imagePath'];
        $defaultImage= Yii::$app->params['defaultImage'];
        return $this->render('index',['bulletins'=>$bulletins, 'path'=>$imagePath, 
                                      'no_photo'=>$defaultImage, 'themes'=>$themes]);
    }

    public function actionSearch() {
        $search=$_GET['search'];
        $bulletins = BulletinsRecord::find()
                ->where([
                    'AND',
                    ['status' => 'public'],
                    [
                        'OR',
                        ['like','title',$search],
                        ['like','info',$search],
                        ['like','city',$search],
                    ]
                ])
                ->all();
        $themes = ThemesRecord::find()
                ->all();
        Yii::$app->session->setFlash(
                'info',
                'Поиск по контенту: <strong>'.$search.'</strong>'
                );
        $imagePath= Yii::$app->params['imagePath'];
        $defaultImage= Yii::$app->params['defaultImage'];
        return $this->render('index',['bulletins'=>$bulletins, 'path'=>$imagePath, 
                                      'no_photo'=>$defaultImage, 'themes'=>$themes]);
    }
    
    public function actionAuthinit(){
        $auth= Yii::$app->authManager;
        
        $CreateMyBulletins = $auth->createPermission('CreateMyBulletins');
        $CreateMyBulletins->description="Создание моего объявления";
        $auth->add($CreateMyBulletins);
        
        $EditMyBulletins = $auth->createPermission('EditMyBulletins');
        $EditMyBulletins->description="Редактирование моего объявления";
        $auth->add($EditMyBulletins);
        
        $DeleteMyBulletins = $auth->createPermission('DeleteMyBulletins');
        $DeleteMyBulletins->description="Удаление моего объявления";
        $auth->add($DeleteMyBulletins);
        
        $PublicMyBulletins = $auth->createPermission('PublicMyBulletins');
        $PublicMyBulletins->description="Публикация моего объявления";
        $auth->add($PublicMyBulletins);
        
        
        
        
        
        $EditAnBulletins = $auth->createPermission('EditAnBulletins');
        $EditAnBulletins->description="Редактирование чужого объявления";
        $auth->add($EditAnBulletins);
        
        $DeleteAnBulletins = $auth->createPermission('DeleteAnBulletins');
        $DeleteAnBulletins->description="Удаление чужого объявления";
        $auth->add($DeleteAnBulletins);
        
        $PublicAnBulletins = $auth->createPermission('PublicAnBulletins');
        $PublicAnBulletins->description="Публикация чужого объявления";
        $auth->add($PublicAnBulletins);
        
        
        
        $DeleteAllBulletin = $auth->createPermission('DeleteAllBulletin');
        $DeleteAllBulletin->description="Окончательное удаление объявлений";
        $auth->add($DeleteAllBulletin);
        
        $CreateThemes = $auth->createPermission('CreateThemes');
        $CreateThemes->description="Создание темы";
        $auth->add($CreateThemes);
        
        $EditThemes = $auth->createPermission('EditThemes');
        $EditThemes->description="Редактирование темы";
        $auth->add($EditThemes);
        
        $DeleteThemes = $auth->createPermission('DeleteThemes');
        $DeleteThemes->description="Удаление темы";
        $auth->add($DeleteThemes);
        
        $DeleteAllThemes = $auth->createPermission('DeleteAllThemes');
        $DeleteAllThemes->description="Окончательное удаление тем";
        $auth->add($DeleteAllThemes);
        
        
        $editDB = $auth->createPermission('editDB');
        $editDB->description="Редактирование БД - суперпользователь";
        $auth->add($editDB);
        
        
        $bull_user= $auth->createRole('user');
        $auth->add($bull_user);
        $auth->addChild($bull_user, $CreateMyBulletins);
        $auth->addChild($bull_user, $EditMyBulletins);
        $auth->addChild($bull_user, $DeleteMyBulletins);
        $auth->addChild($bull_user, $PublicMyBulletins);
        
        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);
        $auth->addChild($moderator, $bull_user);
        $auth->addChild($moderator, $EditAnBulletins);
        $auth->addChild($moderator, $PublicAnBulletins);
        
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $DeleteAnBulletins);
        $auth->addChild($admin, $DeleteAllBulletin);
        $auth->addChild($admin, $CreateThemes);
        $auth->addChild($admin, $EditThemes);
        $auth->addChild($admin, $DeleteThemes);
        $auth->addChild($admin, $DeleteAllThemes);
        
        $superuser = $auth->createRole('superuser');
        $auth->add($superuser);
        $auth->addChild($superuser,$admin);
        $auth->addChild($superuser,$editDB);
        
        
        $auth->assign($superuser,4);
        $auth->assign($admin,2);
        
        return $this->render('authinit');
    }
    
    public function actionTestrole(){
        
        $role="";
        
        if (Yii::$app->user->can('createBulletin'))
        {
            $role=" Создание объявления";
        }
        elseif (Yii::$app->user->can('deleteBulletin')) 
        {
            $role="Удаление объявления";
        }
        
        return $this->render('testrole',['role'=>$role]);
    }
    
    public function actionAdvsearch(){
        $bulletins=null;
        $advSearch = new AdvsearchForm();
        $advSearch->pills_="1";
        $advSearch->radio_="1";
        if($advSearch->load(\Yii::$app->request->post()))
        {
            if($advSearch->validate())
            {
                $tmp='';
                if($advSearch->title!=null)
                    $tmp.=" AND title LIKE '%".$advSearch->title."%'";
                
                if($advSearch->info!=null)
                    $tmp.=" AND info LIKE '%".$advSearch->info."%'";
                
                if($advSearch->city!=null)
                    $tmp.=" AND city LIKE '%".$advSearch->city."%'";
                
                if($advSearch->contacts!=null)
                    $tmp.=" AND contacts LIKE '%".$advSearch->contacts."%'";
                
                if($advSearch->date_pub_n!=null)
                    $tmp.=" AND date_pub >='".$advSearch->date_pub_n."'";
                
                if($advSearch->date_pub_o!=null)
                    $tmp.=" AND date_pub <='".$advSearch->date_pub_o."'";
                
                if($advSearch->price!=null)
                {
                    $tmp.=" AND price = ".$advSearch->price;
                    $advSearch->pills_="1";
                }
                if($advSearch->price_from!=null)
                {
                    $tmp.=" AND price >=".$advSearch->price_from;
                    $advSearch->pills_="2";
                }
                if($advSearch->price_to!=null)
                {
                    $tmp.=" AND price <=".$advSearch->price_to;
                    $advSearch->pills_="2";
                }
                if($advSearch->price_more!=null)
                {
                    $advSearch->pills_="3";
                    $sign="";
                    switch($_POST['sign'])
                    {
                        case "1":
                            $sign=">=";
                            $advSearch->radio_="1";
                            break;
                        case "2":
                            $sign="<=";
                            $advSearch->radio_="2";
                            break;
                    }
                    $tmp.=" AND price ".$sign.$advSearch->price_more;
                }
                    
                
                $sql="SELECT * FROM bulletins WHERE status='public'".$tmp;
                $bulletins = BulletinsRecord::findBySql($sql)
                ->all();
            }
            
        }
        return $this->render('advsearch',['adv'=>$advSearch,'bulletins'=>$bulletins]);
    }
    
    public function actionViewBulletin($id=1)
    {
        $prev_url = Yii::$app->request->referrer;
        $bulletin = BulletinsRecord::findOne($id);
        
        return $this->render('viewbulletin',['bulletin'=>$bulletin, 'prev_url'=>$prev_url]);
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        //if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
                $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }

            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        //} else {
        //    return $this->goHome();
        //}
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        
        return $this->render('about');
    }
}
