<?php

use yii\db\Migration;

class m250914_110110_events extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'datetime' => $this->dateTime()->notNull(),
            'stage_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-events-stage_id',
            'events',
            'stage_id',
            'stages',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-events-stage_id', 'events');

        $this->dropTable('events');
    }
}
