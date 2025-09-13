<?php

namespace app\models\work;

use app\models\Projects;
use app\requests\ProjectCreateRequest;

class ProjectsWork extends Projects
{
    public static function fromRequest(ProjectCreateRequest $requestModel): ProjectsWork
    {
        $project = new static();
        $project->name = $requestModel->name;
        $project->start_date = $requestModel->startDate;
        $project->end_date = $requestModel->endDate;

        return $project;
    }
}