<?php

namespace app\controllers;

use app\dto\SumEvenNumbersDto;
use app\services\interfaces\SumCalculatorInterface;
use app\validators\NumbersValidator;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\UnprocessableEntityHttpException;
use yii\web\ServerErrorHttpException;
use Yii;

class ApiController extends Controller
{
    private SumCalculatorInterface $calculator;

    public function __construct($id, $module, SumCalculatorInterface $calculator, $config = [])
    {
        $this->calculator = $calculator;
        parent::__construct($id, $module, $config);
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($action->id === 'sum-even') {
            Yii::$app->request->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionSumEven()
    {
        try {
            $request = Yii::$app->request->getBodyParams();

            if (!isset($request['numbers'])) {
                throw new BadRequestHttpException('Missing "numbers" key in request.');
            }

            if (!is_array($request['numbers'])) {
                throw new UnprocessableEntityHttpException('"numbers" must be an array of numbers.');
            }

            $dto = new SumEvenNumbersDto($request['numbers']);

            $validator = new NumbersValidator();
            if (!$validator->validate($dto->getNumbers())) {
                throw new UnprocessableEntityHttpException('Неправильний формат даних. Очікуються лише числа.');
            }

            $sum = $this->calculator->calculate($dto);

            return [
                'status' => 'success',
                'sum' => $sum,
            ];

        } catch (BadRequestHttpException | UnprocessableEntityHttpException $e) {
            Yii::$app->response->statusCode = $e->statusCode;
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

        } catch (\TypeError $e) { // 🔹 Catch TypeError
            Yii::$app->response->statusCode = 422;
            return [
                'status' => 'error',
                'message' => 'Неправильний формат даних. Очікуються лише числа.',
            ];
            
        } catch (\Exception $e) {
            Yii::$app->response->statusCode = 500;
            return [
                'status' => 'error',
                'message' => 'Внутрішня помилка сервера.',
            ];
        }
    }

}
