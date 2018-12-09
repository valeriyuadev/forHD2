<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bonuses".
 *
 * @property int $id
 * @property string $title
 * @property int $total
 */
class Bonus extends PrizeBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonuses';
    }
}
