<?php

namespace frontend\controllers;

use common\models\Reviews;
use frontend\helpers\StatusHelper;
use yii\web\Controller;
use common\models\Rental;

class RentalController extends Controller
{
    public function actionIndex(): string
    {
        $model = Rental::findBySql('SELECT * FROM rental WHERE status=' . Rental::STATUS_ACTIVE)->all();

        return $this->render('index', compact('model'));
    }

    public function actionDetails($id): string
    {
        $model = Rental::findBySql('SELECT * FROM rental WHERE id=' . $id)->one();
        $review = new Reviews();

        return $this->render('details', compact('model', 'review'));
    }
}