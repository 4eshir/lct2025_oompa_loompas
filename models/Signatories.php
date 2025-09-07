<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "signatories".
 *
 * @property int $id
 * @property int $note_id
 * @property string $signatory_type
 * @property int $user_id
 * @property string $status
 *
 * @property Notes $note
 */
class Signatories extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'signatories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note_id', 'signatory_type', 'user_id', 'status'], 'required'],
            [['note_id', 'user_id'], 'integer'],
            [['signatory_type', 'status'], 'string', 'max' => 64],
            [['note_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notes::class, 'targetAttribute' => ['note_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'note_id' => 'Note ID',
            'signatory_type' => 'Signatory Type',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Note]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNote()
    {
        return $this->hasOne(Notes::class, ['id' => 'note_id']);
    }

}
