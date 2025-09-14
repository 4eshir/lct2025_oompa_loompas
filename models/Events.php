<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $datetime
 * @property int $stage_id
 *
 * @property Stages $stage
 */
class Events extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'datetime', 'stage_id'], 'required'],
            [['datetime'], 'safe'],
            [['stage_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'datetime' => 'Datetime',
            'stage_id' => 'Stage ID',
        ];
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
