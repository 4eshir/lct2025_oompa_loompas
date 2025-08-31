<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property int $journal_id
 * @property string $note
 *
 * @property Journals $journal
 * @property Signatories[] $signatories
 */
class Notes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['journal_id', 'note'], 'required'],
            [['journal_id'], 'integer'],
            [['note'], 'string'],
            [['journal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Journals::class, 'targetAttribute' => ['journal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_id' => 'Journal ID',
            'note' => 'Note',
        ];
    }

    /**
     * Gets query for [[Journal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJournal()
    {
        return $this->hasOne(Journals::class, ['id' => 'journal_id']);
    }

    /**
     * Gets query for [[Signatories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSignatories()
    {
        return $this->hasMany(Signatories::class, ['note_id' => 'id']);
    }

}
