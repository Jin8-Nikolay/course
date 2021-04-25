<?php

/* @var $this yii\web\View */


use yii\helpers\Html;

$this->title = 'Аренда';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (count($model)): ?>
    <?php foreach ($model as $rental): ?>
        <div class="well">
            <h3><?= $rental->name ?></h3>
            <p>
                <?= $rental->price ?>
            </p>
            <p>
                <?= $rental->coordinate ?>
            </p>
            <a href="/rental/details/<?= $rental->id ?>">Подробнее</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
