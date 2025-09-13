<?php

namespace app\models\work;

use app\models\Stages;

class StagesWork extends Stages
{
    public static function fromRequest(array $stageRequest): StagesWork
    {
        $stage = new static();
        $stage->name = $stageRequest['name'];
        $stage->project_id = $stageRequest['projectId'];
        $stage->start_date = $stageRequest['startDate'];
        $stage->end_date = $stageRequest['endDate'];

        return $stage;
    }
}