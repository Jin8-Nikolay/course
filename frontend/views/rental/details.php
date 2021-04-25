<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\slider\Slider;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Аренда', 'url' => ['rental/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="well">
    <h1><?= $model->name ?></h1>
    <p>
    <h2>Цена</h2><?= $model->price ?> ₴</p>
    <p>
    <h2>Город</h2><?= $model->city ?>.</p>
    <p>
    <h2>Координаты</h2><?= $model->coordinate ?>.</p>
    <p>
    <h2>Описание</h2><?= $model->rentalDescription->description ?> </p>
    <p>
    <h2>Условия</h2><?= $model->rentalDescription->conditions ?> </p>
    <p>
    <h2>Заметки</h2><?= $model->rentalDescription->notes ?> </p>
    <?php

    $images = preg_split('/\s+/', $model->rentalDescription->photos);
    //    $images = $model->getPhotos($model->rentalDescription->photos);

    echo \aki\imageslider\ImageSlider::widget([
        'baseUrl' => Yii::getAlias('@web/upload'),
        'nextPerv' => true,
        'indicators' => false,
        'classes' => 'img-rounded',
        'images' => [
            [
                'active' => true,
                'src' => $images[0],
                'title' => 'image',

            ],
            [
                'src' => $images[1],
                'title' => 'image',
            ],
        ],
    ]);
    ?>
</div>

<div class="well">
    <h1>Отзывы</h1>
    <div class="rental-form">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($review, 'text')->textarea() ?>
        <?=
        $form->field($review, 'appraisal')->widget(Slider::classname(), [
            'pluginOptions' => [
                'min' => 0,
                'max' => 10,
                'step' => 1
            ]
        ])->label(false);
        ?>

        <?= $form->field($review, 'id_rental')->hiddenInput(['value' => $model->id])->label(false) ?>

        <?= $form->field($review, 'id_user')->hiddenInput(['value' => Yii::$app->user->getId()])->label(false) ?>


        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
