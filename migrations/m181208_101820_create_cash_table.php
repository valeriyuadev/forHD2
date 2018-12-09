<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181208_101817_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';
        
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('cash', [
            'id'    => $this->primaryKey(),
            'user'  => $this->string()->notNull(),
            'title' => $this->string()->notNull(),            
            'total' => $this->integer()->notNull(),
            'done'  => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
