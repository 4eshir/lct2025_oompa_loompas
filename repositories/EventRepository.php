<?php

namespace repositories;

use app\models\work\EventsWork;

class EventRepository
{
    /**
     * @param array $conditions ['condition', 'column' 'value']
     */
    public function show(array $conditions = []): array
    {
        $base = EventsWork::find();
        if (count($conditions) > 0) {
            foreach ($conditions as $condition) {
                $base = $base->andWhere($condition);
            }
        }

        return $base->all();
    }
}