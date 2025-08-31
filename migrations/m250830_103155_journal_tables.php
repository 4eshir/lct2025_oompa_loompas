<?php

use yii\db\Migration;

class m250830_103155_journal_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Проекты (изначальная сущность)
        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date()->notNull(),
        ]);

        // Стадии проектов
        $this->createTable('stages', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'name' => $this->string(512)->notNull(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date()->notNull(),
        ]);

        // Список журналов (каждый журнал связан с одним проектом)
        $this->createTable('journals', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'stage_id' => $this->integer()->notNull(),
        ]);

        // Записи в журналах в формате json
        $this->createTable('notes', [
            'id' => $this->primaryKey(),
            'journal_id' => $this->integer()->notNull(),
            'note' => $this->json()->notNull(),
        ]);

        // Подписанты для записей в журналах
        $this->createTable('signatories', [
            'id' => $this->primaryKey(),
            'note_id' => $this->integer()->notNull(),
            'signatory_type' => $this->string(64)->notNull(),
            'status' => $this->string(64)->notNull()
        ]);

        $this->addForeignKey(
            'fk-stages-project_id',
            'stages',
            'project_id',
            'projects',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-journals-stage_id',
            'journals',
            'stage_id',
            'stages',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-notes-journal_id',
            'notes',
            'journal_id',
            'journals',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-signatories-note_id',
            'signatories',
            'note_id',
            'notes',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-signatories-note_id', 'signatories');
        $this->dropForeignKey('fk-notes-journal_id', 'notes');
        $this->dropForeignKey('fk-journals-stage_id', 'journals');
        $this->dropForeignKey('fk-stages-project_id', 'stages');

        $this->dropTable('signatories');
        $this->dropTable('notes');
        $this->dropTable('journals');
        $this->dropTable('stages');
        $this->dropTable('projects');
    }
}
