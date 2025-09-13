<?php

namespace app\requests;

use app\models\work\ProjectsWork;
use yii\base\Model;

class NotesCreateRequest extends Model
{
    /**
     * @example
     * [
     *  {
     *    "shortName": "uups",
     *    "description": "somebody...",
     *    "signatories": [
     *       {
     *          "type": "worker",
     *          "user_id": 1,
     *          "status": "signed"
     *       },
     *       {
     *          "type": "checker",
     *          "user_id": 2,
     *          "status": "unsigned"
     *       }
     *    ]
     *  },
     *  ...
     * ]
     */
    public array $notes = [];

    public function rules(): array
    {
        return [
            [['stages'], 'required'],
            [['stages'], 'safe'],
        ];
    }
}