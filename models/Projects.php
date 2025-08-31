<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 *
 * @property Journals[] $journals
 */
class Projects extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start_date', 'end_date'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 512],
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
        return $this->hasMany(Journals::class, ['project_id' => 'id']);
    }

}
