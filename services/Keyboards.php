<?php

namespace app\services;

use app\models\Projects;
use app\models\Signatories;
use app\models\work\SignatoriesWork;
use yii\helpers\ArrayHelper;

class Keyboards
{
    public const TASK_ACTIONS = [
        [
            ['text' => 'Выполнено'],
            ['text' => 'В работе'],
            ['text' => 'Отменено'],
        ]
    ];

    public static function getProjectsByWorker(int $userId): array
    {
        $projects = Projects::find()
            ->joinWith('stages')
            ->joinWith('journals')
            ->joinWith('notes')
            ->joinWith('signatories')
            ->where(['signatory_type' => SignatoriesWork::TYPE_WORKER])
            ->andWhere(['user_id' => $userId])
            ->all();

        $projectNames = ArrayHelper::getColumn($projects, 'name');

        return [
            [
                $projectNames
            ]
        ];
    }
}