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
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username'   => $this->string()->notNull()->unique(),
            'auth_key'   => $this->string(32)->notNull(),

            'email'      => $this->string(),
            'adress'     => $this->string()->notNull(),

            'bank_account'      => $this->string()->notNull(),
            'bank_request_url'  => $this->string()->notNull(),
            'bank_response_url' => $this->string()->notNull(),

            'status'     => $this->smallInteger()->notNull()->defaultValue(10),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
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
