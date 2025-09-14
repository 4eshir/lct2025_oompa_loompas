<?php

namespace app\requests;

use app\models\work\StagesWork;
use yii\base\Model;

class EventCreateRequest extends Model
{
    public string $name = '';
    public string $description = '';
    public string $datetime = '';
    public int $stageId = 0;

    /**
     * @example
     * {
     *    "name": "Something event",
     *    "description": "So long text about event, include..."
     *    "datetime": "2025-01-01 19:42:00"
     *    "stageId": 1
     * }
     */

    public function rules(): array
    {
        return [
            [['name', 'description', 'datetime', 'stageId'], 'required'],
            [['name', 'description'], 'string'],
            [['datetime'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['stageId'], 'integer'],
            [['stageId'], 'exist', 'targetClass' => StagesWork::class, 'targetAttribute' => 'id'],
        ];
    }
}