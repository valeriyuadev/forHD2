<?php

namespace app\services;

use app\models\User;

interface SenderInterface {
    public function send();
}

abstract class PrizeSenderFactory
{
    /**
     * @return \app\services\SenderManagerAbstract
     */
    public static function Create(PrizeInterface $prize)
    {
        if( $prize instanceof Gift ) {
            return new GiftSenderManager( $prize );
        }
        elseif( $prize instanceof Cash ) {
            return new CashSenderManager( $prize );
        }
    }
}

trait SenderBaseTrait {
    protected $_prize;
    protected $_sender;

    public function __construct( $prize )
    {
        $this->_prize = $prize;
    }
}

abstract class SenderManagerAbstract {
    abstract public function toAdress();
    /*
    abstract public function toEmail();
    abstract public function toSms();
    abstract public function toAldebaran();
    */
}

interface SenderManagerBankInterface {
    public function toBank();
}

class CashSenderManager implements
    SenderInterface,
    SenderManagerBankInterface
{
    use SenderBaseTrait;

    /**
     * @return \app\services\GiftSenderManager
     */
    public function toBank()
    {
        $this->_sender = new CashSenderToBank( $this->_prize );

        return $this;
    }

    public function send() {
        return $this->_sender->send();
    }

    public function setPrize( $prize ) {
        $this->_prize = $prize;
    }
}

class CashSenderToBank implements SenderInterface {
    use SenderBaseTrait;

    public function send() {
        // $user = User::findOne( $this->_prize->user );
        /** @var $user \app\models\User */
        //$bankUrlRequest  = $user->bank_request_url;
        //$bankUrlResponse = $user->bank_response_url;
        //$sum = $this->_prize
        // ... деньги на счет ..
        //curl() ....

        return true;
    }
}

class GiftSenderManager extends SenderManagerAbstract implements SenderInterface
{
    use SenderBaseTrait;

    /**
     * @return \app\services\GiftSenderManager
     */
    public function toAdress()
    {
        $this->_sender = new GiftSenderToAdress( $this->_prize );

        return $this;
    }

    public function send() {
        return $this->_sender->send();
    }
}

class GiftSenderToAdress implements SenderInterface {
    use SenderBaseTrait;

    public function send() {
        return true;
    }
}