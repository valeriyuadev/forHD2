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
class PrizeBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total', 'user', 'done'], 'integer'],
            [['done'], 'default', 'value' => null],
            [['title'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'title' => 'Title',
            'total' => 'Total',
            'user'  => 'User',
        ];
    }
}
