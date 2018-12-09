<?php

namespace app\services;

use yii;

interface PrizeInterface {
    public function getInfo();
    public function getTotal();
    public function getTitle();
    public function getUser();
    public function getArray();
}

abstract class Prize implements PrizeInterface {
    protected $_title;
    protected $_total;
    protected $_user;

    public static function Create( $prizeData ) {
        $prizeType = $prizeData[ 'prize' ];
        $DS = DIRECTORY_SEPARATOR;

        $class = sprintf( '\\%s\\%s', __NAMESPACE__, $prizeType );

        if( ! class_exists( $class ) ) {
            throw new \Exception("Class not found - " . $class . "php" );
        }

        $gift = new $class();

        foreach( $prizeData as $k => $v ) {
            $method = "set" . ucfirst( $k );

            if( method_exists( $gift, $method ) ) {
                call_user_func_array( array( $gift, $method ), array( $v ) );

                //$gift->{$method}( $v );
            }
        }

        return $gift;
    }

    public function setTotal( $total ) {
        $this->_total = $total;
    }

    public function setTitle( $title ) {
        $this->_title = $title;
    }

    public function setUser( $user ) {
        $this->_user = $user;
    }
}

trait PrizeInfoTrait {
    public function getInfo() {
        return sprintf( "%s, %s$", $this->getTitle(), $this->getTotal(), '$' );
    }

    public function getTotal() {
        return $this->_total;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function getUser() {
        return $this->_user;
    }

    public function getArray() {
        return [
            'user'  => $this->_user,
            'total' => $this->_total,
            'title' => $this->_title,
        ];
    }
}

class Cash extends Prize {
    use PrizeInfoTrait;
}

class Gift extends Prize {
    use PrizeInfoTrait;

    public function getInfo() {
        return $this->getTitle();
    }
}

class Bonus extends Prize {
    use PrizeInfoTrait;
}