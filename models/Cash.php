<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cashes".
 *
 * @property int $id
 * @property string $title
 * @property int $total
 */
class Cash extends PrizeBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cash';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
}
