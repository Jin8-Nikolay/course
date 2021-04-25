<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Rental */
/* @var $description common\models\RentalDescription */

$this->title = 'Создать Аренду';
$this->params['breadcrumbs'][] = ['label' => 'Аренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'description' => $description,
    ]) ?>

</div>
