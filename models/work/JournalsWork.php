<?php

namespace app\models\work;

use app\models\Journals;
use app\requests\JournalCreateRequest;

class JournalsWork extends Journals
{

    public static function fromRequest(JournalCreateRequest $requestModel): JournalsWork
    {
        $journal = new static();
        $journal->name = $requestModel->name;
        $journal->stage_id = $requestModel->stageId;

        return $journal;
    }
}