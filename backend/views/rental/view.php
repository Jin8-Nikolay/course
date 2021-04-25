<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Rental */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Аренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rental-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'name',
            'price',
            'city',
            'coordinate:ntext',
            [
                'format' => 'html',
                'label' => 'Фотки',
                'value' => function ($model) {
                    return $model->getPhotos($model->rentalDescription->photos);
                }
            ],
            'rentalDescription.description',
            'rentalDescription.conditions',
            'rentalDescription.notes',
        ],
    ]) ?>

</div>
