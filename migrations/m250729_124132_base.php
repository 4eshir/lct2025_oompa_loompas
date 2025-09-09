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
        $this->createTable('journal_notes', [
            'id' => $this->primaryKey(),
            'journal_name' => $this->string(32),
            'note' => $this->json(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

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

        $this->createTable('objects', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('geo_positions');
        $this->dropTable('journal_notes');
        $this->dropTable('users');
        $this->dropTable('objects');

        return true;
    }
}
