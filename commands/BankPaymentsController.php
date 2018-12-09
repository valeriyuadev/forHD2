<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Cash;

class BankPaymentsController extends Controller
{
    public $message;

    public function actionSendToBank() {
        echo PHP_EOL . "BEGIN";

        $users = Cash::find()
            ->innerJoinWith( 'users' )
            ->where( ['done' => null] )
            ->orderBy( ['id' => SORT_ASC] );

        $update_ids = [];
        $count      = 0;
        $bathCount  = 2;

        foreach( $users->each( $bathCount ) as $cash ) {
            $prize = ( new \app\services\ConvertorManager( $cash ) )
                        ->getConvertor()
                        ->toPrize();

            $res = \app\services\PrizeSenderFactory::Create( $prize )->toBank();

            if( ! $res ) {
                echo PHP_EOL . "\terror send - ID cash #{$cash->id}";

                continue;
            }

            array_push( $update_ids, $cash->id );    
            
            echo PHP_EOL . "\t-> {$cash->users->username}, cash {$cash->total}$";

            if( ++$count % $bathCount == 0 ) {
                $this->update( $update_ids );

                $update_ids = [];
            }
        }

        $this->update( $update_ids );

        echo PHP_EOL . "END";
    }

    private function update( $update_ids ) {
        if( sizeof( $update_ids ) ) {
            Cash::updateAll(['done' => 1], ['in', 'id', $update_ids]);

            echo PHP_EOL . "\tsended ID - " . implode(', ', $update_ids);
        }
    }
}
