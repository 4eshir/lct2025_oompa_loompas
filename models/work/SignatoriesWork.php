<?php

namespace app\models\work;

use app\models\Signatories;

class SignatoriesWork extends Signatories
{
    public const TYPE_WORKER = 'worker';
    public const TYPE_CONTROLLER = 'controller';
}