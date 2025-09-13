<?php

use yii\db\Migration;

/**
 * Class m250729_124132_base
 */
class m250729_124132_base extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('geo_positions', [
            'id' => $this->primaryKey(),
            'latitude' => $this->double(),
            'longitude' => $this->double(),
            'table_name' => $this->string(),
            'row_id' => $this->integer(),
            'confirm' => $this->smallInteger(),
        ]);

        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(128),
            'password' => $this->string(),
            'telegram_id' => $this->integer(),
            'role' => $this->string(32)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('geo_positions');
        $this->dropTable('users');

        return true;
    }
}
