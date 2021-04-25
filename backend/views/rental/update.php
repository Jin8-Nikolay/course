<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Rental */
/* @var $description common\models\RentalDescription */

$this->title = 'Обновить Аренду: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Аренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="rental-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'description' => $description,
    ]) ?>

</div>
