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

        $class = "\\app\\models\\" . $prize['prize'];

        unset($prize['prize']);

        try {
            $this->_model = new $class();

            $this->setData($prize);
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
