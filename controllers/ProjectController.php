<?php

namespace app\controllers;

use app\models\work\ProjectsWork;
use app\models\work\StagesWork;
use app\requests\ProjectCreateRequest;
use app\requests\StagesCreateRequest;
use app\services\DevelopmentBot;
use app\services\Keyboards;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class ProjectController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestModel = new ProjectCreateRequest();
        $requestModel->load(json_decode(Yii::$app->request->getRawBody(), true), '');

        if ($requestModel->validate()) {
            $project = ProjectsWork::fromRequest($requestModel);
            $project->save();

            return [
                'success' => true,
                'message' => "Проект $requestModel->name создан"
            ];
        }
    }

    public function actionAddStages()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestModel = new StagesCreateRequest();
        $requestModel->load(json_decode(Yii::$app->request->getRawBody(), true), '');

        if ($requestModel->validate()) {
            foreach ($requestModel->stages as $stage) {
                $stage = StagesWork::fromRequest($stage);
                $stage->save();
            }

            return [
                'success' => true,
                'message' => "Стадии для проекта созданы"
            ];
        }
    }
}
