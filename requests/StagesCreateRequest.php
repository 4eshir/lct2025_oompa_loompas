<?php

namespace app\requests;

use app\models\work\ProjectsWork;
use yii\base\Model;

class StagesCreateRequest extends Model
{
    /**
     * @example
     * [
     *  {
     *    "projectId": 1,
     *    "name": "StageName",
     *    "startDate": "1900-01-01",
     *    "endDate": "1900-01-01",
     *  },
     *  ...
     * ]
     */
    public array $stages = [];

    public function rules(): array
    {
        return [
            [['stages'], 'required'],
            [['stages'], 'safe'],
        ];
    }
}