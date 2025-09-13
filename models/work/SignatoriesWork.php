<?php

namespace app\models\work;

use app\models\Signatories;

class SignatoriesWork extends Signatories
{
    public const TYPE_WORKER = 'worker';
    public const TYPE_CONTROLLER = 'controller';

    public static function fromRequest(array $signRequest, int $noteId): SignatoriesWork
    {
        $sign = new static();
        $sign->note_id = $noteId;
        $sign->signatory_type = $signRequest['type'];
        $sign->user_id = $signRequest['user_id'];
        $sign->status = $signRequest['status'];

        return $sign;
    }
}