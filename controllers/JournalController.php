<?php

namespace app\controllers;

use app\models\work\JournalsWork;
use app\models\work\NotesWork;
use app\models\work\SignatoriesWork;
use app\requests\JournalCreateRequest;
use app\requests\NotesCreateRequest;
use app\requests\ProjectCreateRequest;
use app\services\DevelopmentBot;
use app\services\Keyboards;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class JournalController extends Controller
{
    public $enableCsrfValidation = false;

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
        else {
            var_dump($requestModel->getErrors());
        }
    }

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
        else {
            var_dump($requestModel->getErrors());
        }
    }
}
