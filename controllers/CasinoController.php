<?php

namespace app\controllers;

use app\models\User;
use app\services\PrizeModifierFactory;
use app\services\PrizeSenderFactory;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\services\Azino777;
use app\services\Prize;

class CasinoController extends Controller
{
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGenerate()
    {
        return $this->render('generated', [
            'prize' => Prize::Create(
                Azino777::generateSpin()
            ),
        ]);
    }

    public function actionSendGift()
    {
        $prize = $this->_getPrizeFromSession();

        $sender = PrizeSenderFactory::Create(
            $prize
        )->toAdress();

        if( $sender->send() ) {
            $this->_setFlash(
                "Приз едет - " . User::findOne( $prize->getUser() )->adress,
                'success'
            );
        }
        else {
            $this->_setFlash(
                "Ошибка отправки приза",
                'error'
            );
        }

        return $this->redirect( ['index'] );
    }

    /**
     * @throws Exception
     */
    public function actionConvert()
    {
        $Cash = $this->_getPrizeFromSession();

        $Bonus = ( new \app\services\ConvertorManager( $Cash ) )
                        ->getConvertor()
                        ->toBonus();

        PrizeModifierFactory::Create(
            $Bonus
        )->insert();

        $this->_setFlash(
            'success',
            "Деньги сконвертированы в бонусы"
        );

        return $this->render('convert', [
            'prize' => $Bonus,
        ]);
    }

    /**
     * @throws Exception
     */
    public function actionApply()
    {
        $model = PrizeModifierFactory::Create(
            $this->_getPrizeFromSession()
        )->insert();

        Yii::error( $model );

        $this->_setFlash(
            "Вы приняли приз",
            'success'
        );

        return $this->render('index');
    }

    public function actionReject()
    {
        Azino777::clearGame();

        $this->_setFlash(
            "Вы отказались от приза",
            'info'
        );

        return $this->redirect(['index']);
    }

    private function _clearWon() {
        Yii::$app->session->remove( 'won' );
    }

    private function _setFlash( $mess, $key = 'success' ) {
        Yii::$app->session->setFlash(
            $key,
            $mess
        );
    }

    /** @return \app\services\PrizeInterface */
    private function _getPrizeFromSession() {
        return Prize::Create(
            \Yii::$app->session->get( 'won' )
        );
    }
}
