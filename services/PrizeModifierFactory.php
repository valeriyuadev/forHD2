<?php

namespace app\services;

interface PrizeSaveInterface {
    public function insert();
}

interface PrizeUpdateInterface {
    public function update();
}

abstract class PrizeModifier implements PrizeSaveInterface
{
    protected $_prize;
    protected $_model;

    public function __construct(PrizeInterface $prize)
    {
        $this->_prize = clone $prize;

        $class = get_class( $prize );

        $class = substr(
            $class,
            strrpos( $class, '\\' ) + 1
        );

        $className = "\\app\\models\\" . $class;

        try {
            $this->_model = new $className();

            $modelData = $prize->getArray();

            $this->setData( $modelData );
        } catch (\Exception $e) {
            // ...
            throw $e;
        }
    }

    protected function setData( $data )
    {
        $this->_model->attributes = $data;
    }
}

trait PrizeModifierTrait {
    /**
     * @return \yii\db\ActiveRecord
     */
    public function insert()
    {
        $this->_model->insert();

        return $this->_model;
    }

    public function update( $data )
    {
        $model = $this->_model;

        foreach( $data as $k => $v ) {
            if( isset( $model[ $k ] ) ) {
                $model[ $k ] = $v;
            }
        }

        $model->update();

        return $model;
    }
}

abstract class PrizeModifierFactory {
    /**
     * @param \app\services\PrizeInterface
     *
     * @throws \Exception
     */
    public static function Create( PrizeInterface $prize )
    {
        if ( $prize instanceof Cash) {
            return new CashModifier($prize);
        }
        elseif( $prize instanceof Gift ) {
            return new GiftModifier( $prize );
        }
        elseif( $prize instanceof Bonus ) {
            return new BonusModifier($prize);
        }

        throw new \Exception( 'Modifier not exists for class - ' . get_class( $className ) );
    }
}

class CashModifier extends PrizeModifier
{
    use PrizeModifierTrait;
}

class GiftModifier extends PrizeModifier
{
    use PrizeModifierTrait;
}

class BonusModifier extends PrizeModifier
{
    use PrizeModifierTrait;
}


