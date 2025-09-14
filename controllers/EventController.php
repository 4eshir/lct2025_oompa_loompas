<?php

namespace app\controllers;

use app\models\work\EventsWork;
use app\models\work\ProjectsWork;
use app\models\work\StagesWork;
use app\requests\EventCreateRequest;
use app\requests\ProjectCreateRequest;
use app\requests\StagesCreateRequest;
use app\services\DevelopmentBot;
use app\services\Keyboards;
use repositories\EventRepository;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class EventController extends Controller
{
    public $enableCsrfValidation = false;

    public EventRepository $eventRepository;

    public function __construct($id, $module, EventRepository $eventRepository, $config = [])
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Создает событие, связанное с конкретным стейджем проекта
     *
     * Ожидаемый формат body {@see ProjectCreateRequest}
     */
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestModel = new EventCreateRequest();
        $requestModel->load(json_decode(Yii::$app->request->getRawBody(), true), '');

        if ($requestModel->validate()) {
            $event = EventsWork::fromRequest($requestModel);
            $event->save();

            return [
                'success' => true,
                'message' => "Событие $event->name создано"
            ];
        }
    }

    /**
     * Эндпоинт для внешнего запроса
     *
     * Ожидаемый формат query params {@see StagesCreateRequest}
     */
    public function actionGetEvents(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestModel = new EventCreateRequest();
        $requestModel->load(json_decode(Yii::$app->request->get(), true), '');

        $conditions = [];
        if ($requestModel->name !== '') {
            $conditions[] = ['like', 'name', '%' . $requestModel->name . '%'];
        }

        if ($requestModel->description !== '') {
            $conditions[] = ['like', 'description', '%' . $requestModel->description . '%'];
        }

        if ($requestModel->datetime !== '') {
            $conditions[] = ['=', 'datetime', $requestModel->datetime];
        }

        if ($requestModel->stageId !== 0) {
            $conditions[] = ['=', 'stage_id', $requestModel->stageId];
        }

        $result = [];
        $events = $this->eventRepository->show($conditions);
        foreach ($events as $event) {
            $result[] = $event->toArray();
        }

        return $result;
    }
}
