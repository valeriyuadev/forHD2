<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prizes_names".
 *
 * @property int $id
 * @property string $title
 * @property int $sum
 */
class PrizesNames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prizes_names';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sum'], 'integer'],
            [['title'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'sum' => 'Sum',
        ];
    }
}
