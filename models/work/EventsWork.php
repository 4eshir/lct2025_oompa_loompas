<?php

namespace app\models\work;

use app\models\Events;
use app\requests\EventCreateRequest;

class EventsWork extends Events
{

    public static function fromRequest(EventCreateRequest $requestModel)
    {
        $event = new static();
        $event->name = $requestModel->name;
        $event->description = $requestModel->description;
        $event->datetime = $requestModel->datetime;
        $event->stage_id = $requestModel->stageId;

        return $event;
    }
}