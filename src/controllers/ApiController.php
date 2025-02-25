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

    public function actionSumEven()
    {
        try {
            $request = Yii::$app->request->getBodyParams();

            $dto = new SumEvenNumbersDto($request);

            $sum = $this->calculator->calculate($dto);

            return $this->asJson([
                'sum' => $sum,
            ]);

        } catch (InvalidArgumentException $e) {
            Yii::$app->response->statusCode = 400;
            return $this->asJson( [
                'message' => $e->getMessage(),
            ]);
    
        } catch (UnprocessableEntityHttpException $e) {
            Yii::$app->response->statusCode = $e->statusCode;
            return $this->asJson( [
                'message' => $e->getMessage(),
            ]);
        } catch (\TypeError $e) {
            Yii::$app->response->statusCode = 422;
            return $this->asJson( [
                'message' => 'Incorrect format. Numbers required.',
            ]);
        } catch (\Exception $e) {
            Yii::$app->response->statusCode = 500;
            return $this->asJson( [
                'message' => $e->getMessage(),
            ]);
        }
    }
}
