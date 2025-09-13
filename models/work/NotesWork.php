<?php

namespace app\models\work;

use app\models\Notes;
use app\models\Signatories;

class NotesWork extends Notes
{
    public static function createJson(string $shortName, string $description): string
    {
        return json_encode([
            'shortName' => $shortName,
            'description' => $description,
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function fromRequest(array $noteRequest)
    {
        $note = new static();
        $note->journal_id = $noteRequest['journalId'];
        $note->note = self::createJson($noteRequest['shortName'], $noteRequest['description']);

        return $note;
    }

    public function getSignatoriesArray(array $signRequest)
    {
        $signs = [];
        foreach ($signRequest as $signRequestItem) {
            $signs[] = SignatoriesWork::fromRequest($signRequestItem, $this->id);
        }

        return $signs;
    }
}