<?php

namespace app\services;

use yii;

interface CasinoInterface {
    public static function generateSpin();
}

class Azino777 implements CasinoInterface {
    public static function generateSpin()
    {
        self::clearGame();

        $data = [
            'prize' => 'Cash',  'total' => 11, 'title' => 'Urrrraaa',
            //'prize' => 'Gift',  'total' => 1,  'title' => 'Hohohoh',
            //'prize' => 'Bonus', 'total' => 20, 'title' => 'Mamaaaa',
            'user'  => Yii::$app->user->id,
        ];

        \Yii::$app->session->set( 'won', $data );

        return $data;
    }

    public static function clearGame() {
        Yii::$app->session->remove( 'won' );
    }
}