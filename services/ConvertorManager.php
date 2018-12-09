<?php

namespace app\services;

interface ConvertorInterface {
    public function toCash();
    public function toGift();
    public function toBonus();
}


class ConvertorManager {
    private $_prize;
    /** @var $_convertor ConvertorInterface */
    private $_convertor = null;

    public function __construct( $prize )
    {
        if( $prize instanceof PrizeInterface
            || $prize instanceof \yii\db\ActiveRecord )
        {
            $this->_prize = $prize;
        }
        else {
            throw new \Exception('Converter - unknown type of parametr');
        }
    }

    public function getConvertor() {
        if( $this->_convertor instanceof Convertor ) {
            return $this->_convertor;
        }

        if( $this->_prize instanceof Cash ) {
            $this->_convertor = new ConvertorCash( $this->_prize );
        }
        elseif( $this->_prize instanceof \app\models\Cash ) {
            $this->_convertor = new ConvertorCashActiveRecord( $this->_prize );
        }
        elseif( $this->_prize instanceof Gift ) {
            // $this->_convertor = ....
        }
        elseif( $this->_prize instanceof Bonus ) {
            // $this->_convertor = ....
        }
        else {
            throw new \Exception( 'Unknown type of "Prize"' );
        }

        return $this->_convertor;
    }
}

abstract class Convertor {
    /**
     * @var $_prize \app\services\Prize
     */
    protected $_prize;

    public function toCash()
    {
        return $this->_prize;
    }
}

trait ConvertorTrait {
    public function __construct( Cash $prize )
    {
        $this->_prize = $prize;
    }
}

trait ConvertorActiveRecordTrait {
    public function __construct( \yii\db\ActiveRecord $prize )
    {
        $this->_prize = $prize;
    }
}

class ConvertorCashActiveRecord extends Convertor implements ConvertorInterface {
    use ConvertorActiveRecordTrait;

    public function toGift()
    {
        // TODO: ...
    }

    public function toBonus()
    {
        return new \app\models\Bonus([
            'total' => $this->_prize->total,
            'title' => $this->_prize->title,
            'user'  => $this->_prize->user,
        ]);
    }

    public function toPrize()
    {
        if( $this->_prize instanceof \app\models\Cash ) {
            $type = 'Cash';
        }
        elseif( $this->_prize instanceof \app\models\Bonus ) {
            $type = 'Bonus';
        }
        elseif( $this->_prize instanceof \app\models\Gift ) {
            $type = 'Gift';
        }

        return Prize::Create([
            'total' => $this->_prize->total,
            'title' => $this->_prize->title,
            'user'  => $this->_prize->user,
            'prize' => $type,
        ]);
    }
}

class ConvertorCash extends Convertor implements ConvertorInterface {
    use ConvertorTrait;

    public function toGift()
    {
        return Prize::Create([
            'prize' => 'Gift',
            'total' => 1,
            'title' => $this->_prize->getTitle(),
            'user'  => $this->_prize->getUser(),
        ]);
    }

    public function toBonus()
    {
        return Prize::Create([
            'prize' => 'Bonus',
            'total' => $this->_prize->getTotal() * \Yii::$app->params[ 'bonus_koefficient' ],
            'title' => $this->_prize->getTitle(),
            'user'  => $this->_prize->getUser(),
        ]);
    }
}

/*
class ConvertorGift extends Convertor implements ConvertorInterface
{
    ...
}
class ConvertorBonus extends Convertor implements ConvertorInterface
{
    ...
}
*/