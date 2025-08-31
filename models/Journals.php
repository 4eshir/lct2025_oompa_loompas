<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journals".
 *
 * @property int $id
 * @property string $name
 * @property int $stage_id
 *
 * @property Notes[] $notes
 * @property Stages $stage
 */
class Journals extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'stage_id'], 'required'],
            [['stage_id'], 'integer'],
            [['name'], 'string', 'max' => 512],
            [['stage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stages::class, 'targetAttribute' => ['stage_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'stage_id' => 'Stage ID',
        ];
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Notes::class, ['journal_id' => 'id']);
    }

    /**
     * Gets query for [[Stage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStage()
    {
        return $this->hasOne(Stages::class, ['id' => 'stage_id']);
    }

}
