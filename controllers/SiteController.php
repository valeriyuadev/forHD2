<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public $defaultAction = 'login';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add-users'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect( ['casino/index'] ) ;
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAddUsers() {
        $model = User::find()->where( ['username' => '1'] )->one();

        if( empty( $model ) ) {
            $user = new User();
            
            $user->username = '1';
            $user->email    = '1@user.ua';
            $user->setPassword('1');
            $user->generateAuthKey();
            
            if ($user->save()) {
                //echo 'good';
            }
        }

        $model = User::find()->where( ['username' => '2'] )->one();

        if( empty( $model ) ) {
            $user = new User();
            
            $user->username = '2';
            $user->email     = '2@user.ua';
            $user->setPassword('2');
            $user->generateAuthKey();
            
            if ($user->save()) {
                //echo 'good';
            }
        }
        
        return $this->redirect( ['login'] );
    }
}
