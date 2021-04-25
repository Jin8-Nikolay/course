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
        $model = Rental::findBySql('SELECT * FROM rental')->all();

        return $this->render('index', compact('model'));
    }

    public function actionDetails($id): string
    {
        $model = Rental::findBySql('SELECT * FROM rental WHERE id=' . $id)->one();
        $review = new Reviews();
        if (($post = \Yii::$app->request->post()) != null) {
            $post['Reviews']['date'] = time();
            $review->load($post);
            $review->save();
        }
        $reviews = Reviews::findBySql('SELECT * FROM reviews WHERE id_rental=' . $id)->all();
        return $this->render('details', compact('model', 'review', 'reviews'));
    }

    public function actionRent($id)
    {
        $model = Rental::findBySql('SELECT * FROM rental WHERE id=' . $id)->one();
        ($model->status == Rental::STATUS_ACTIVE) ? $model->status = Rental::STATUS_INACTIVE : $model->status = Rental::STATUS_ACTIVE;
        $model->save();
        return $this->redirect('/rental/index');
    }
}