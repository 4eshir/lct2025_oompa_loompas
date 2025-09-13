<?php

namespace app\requests;

use yii\base\Model;

class ProjectCreateRequest extends Model
{
    public string $name = '';
    public string $startDate = '';
    public string $endDate = '';

    /**
     * @example
     * {
     *    "name": "StageName",
     *    "startDate": "1900-01-01",
     *    "startDate": "1900-01-01",
     * }
     */
    public array $stages = [];

    public function rules(): array
    {
        return [
            [['name', 'startDate', 'endDate'], 'required'],
            [['name', 'startDate', 'endDate'], 'string'],
        ];
    }
}