<?php

namespace app\requests;

use app\models\work\StagesWork;
use yii\base\Model;

class JournalCreateRequest extends Model
{
    public string $name = '';
    public int $stageId = 0;

    /**
     * @example
     * {
     *    "name": "TestJournal",
     *    "stageId": 1
     * }
     */

    public function rules(): array
    {
        return [
            [['name', 'stageId'], 'required'],
            [['name'], 'string'],
            [['stageId'], 'integer'],
            [['stageId'], 'exist', 'targetClass' => StagesWork::class, 'targetAttribute' => 'id'],
        ];
    }
}