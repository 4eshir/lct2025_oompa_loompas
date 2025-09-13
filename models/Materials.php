<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materials".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $name
 * @property string|null $measurement
 * @property int|null $base_count
 * @property int|null $spent_count
 * @property int|null $stage_id
 *
 * @property HistoryMaterialsSpent[] $historyMaterialsSpents
 * @property Stages $stage
 */
class Materials extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'name', 'measurement', 'base_count', 'spent_count', 'stage_id'], 'default', 'value' => null],
            [['base_count', 'spent_count', 'stage_id'], 'integer'],
            [['type'], 'string', 'max' => 128],
            [['name'], 'string', 'max' => 256],
            [['measurement'], 'string', 'max' => 32],
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
            'type' => 'Type',
            'name' => 'Name',
            'measurement' => 'Measurement',
            'base_count' => 'Base Count',
            'spent_count' => 'Spent Count',
            'stage_id' => 'Stage ID',
        ];
    }

    /**
     * Gets query for [[HistoryMaterialsSpents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryMaterialsSpents()
    {
        return $this->hasMany(HistoryMaterialsSpent::class, ['material_id' => 'id']);
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
