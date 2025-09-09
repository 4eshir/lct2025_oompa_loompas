<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journal_notes".
 *
 * @property int $id
 * @property string|null $journal_name
 * @property string|null $note
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class JournalNotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['journal_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_name' => 'Journal Name',
            'note' => 'Note',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
