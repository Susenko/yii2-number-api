<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use app\dto\SumEvenNumbersDto;

class ApiController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    public function actionSumEven()
    {
        $requestData = json_decode(Yii::$app->request->getRawBody(), true);

        if (!isset($requestData['numbers']) || !is_array($requestData['numbers'])) {
            throw new BadRequestHttpException('Invalid input. Expecting an array of numbers.');
        }

        $dto = new SumEvenNumbersDto($requestData['numbers']);

        return ['sum' => $dto->getSumEven()];
    }

}
