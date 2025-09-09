<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "geo_positions".
 *
 * @property int $id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $table_name
 * @property int|null $row_id
 * @property int|null $confirm
 */
class GeoPositions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_positions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'number'],
            [['row_id', 'confirm'], 'integer'],
            [['table_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'table_name' => 'Table Name',
            'row_id' => 'Row ID',
            'confirm' => 'Confirm',
        ];
    }
}
