<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class BankController extends Controller
{
    public function requestAction() {
        echo 'OK - request';
    }

    public function responseAction() {
        echo 'OK - response';
    }
}
