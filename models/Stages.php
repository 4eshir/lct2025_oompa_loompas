<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stages".
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 *
 * @property Journals[] $journals
 * @property Projects $project
 */
class Stages extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'name', 'start_date', 'end_date'], 'required'],
            [['project_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 512],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::class, 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * Gets query for [[Journals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journals::class, ['stage_id' => 'id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::class, ['id' => 'project_id']);
    }

}
