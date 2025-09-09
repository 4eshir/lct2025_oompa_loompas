<?php

use yii\db\Migration;

/**
 * Class m250909_141402_materials
 */
class m250909_141402_materials extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('materials', [
            'id' => $this->primaryKey(),
            'type' => $this->string(128),
            'name' => $this->string(256),
            'measurement' => $this->string(32),
            'base_count' => $this->integer(),
            'spent_count' => $this->integer(),
            'stage_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-materials-stage_id',
            'materials',
            'stage_id',
            'stages',
            'id',
            'CASCADE'
        );

        $this->createTable('history_materials_spent', [
            'id' => $this->primaryKey(),
            'material_id' => $this->integer(),
            'datetime' => $this->dateTime(),
            'count' => $this->integer(),
            'signatory_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-history_materials_spent-material_id',
            'history_materials_spent',
            'material_id',
            'materials',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-history_materials_spent-signatory_id',
            'history_materials_spent',
            'signatory_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-history_materials_spent-signatory_id', 'history_materials_spent');
        $this->dropForeignKey('fk-history_materials_spent-material_id', 'history_materials_spent');

        $this->dropTable('history_materials_spent');

        $this->dropForeignKey('fk-materials-stage_id', 'materials');

        $this->dropTable('materials');
    }
}
