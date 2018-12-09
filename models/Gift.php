<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gifts".
 *
 * @property int $id
 * @property string $title
 * @property int $total
 */
class Gift extends PrizeBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gifts';
    }
}
