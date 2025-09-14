<?php

namespace repositories;

use app\models\work\ProjectsWork;

class ProjectRepository
{
    /**
     * @param array $strictPairs ['column', 'value']
     */
    public function show(array $strictPairs = []): array
    {
        $base = ProjectsWork::find();
        if (count($strictPairs) > 0) {
            foreach ($strictPairs as $pair) {
                $base = $base->andWhere([$pair[0] => $pair[1]]);
            }
        }

        return $base->all();
    }
}