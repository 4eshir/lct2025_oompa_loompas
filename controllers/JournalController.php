<?php

namespace app\controllers;

use app\models\work\JournalsWork;
use app\models\work\NotesWork;
use app\requests\JournalCreateRequest;
use app\requests\NotesCreateRequest;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class JournalController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * Создает журнал, связанный с конкретным стейджем
     *
     * Ожидаемый формат body {@see JournalCreateRequest}
     */
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestModel = new JournalCreateRequest();
        $requestModel->load(json_decode(Yii::$app->request->getRawBody(), true), '');

        if ($requestModel->validate()) {
            $journal = JournalsWork::fromRequest($requestModel);
            $journal->save();

            return [
                'success' => true,
                'message' => "Журнал для проекта создан"
            ];
        }
    }

    /**
     * Создает записи в соответствующем журнале
     *
     * Ожидаемый формат body {@see NotesCreateRequest}
     */
    public function actionAddNotes()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestModel = new NotesCreateRequest();
        $requestModel->load(json_decode(Yii::$app->request->getRawBody(), true), '');

        if ($requestModel->validate()) {
            foreach ($requestModel->notes as $note) {
                $note = NotesWork::fromRequest($note);
                $note->save();

                foreach ($note->getSignatoriesArray($requestModel['signatories']) as $signatory) {
                    $signatory->save();
                }
            }

            return [
                'success' => true,
                'message' => "Журнал для проекта создан"
            ];
        }
    }
}
