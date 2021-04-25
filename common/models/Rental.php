<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%rental}}".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property float|null $price
 * @property string|null $city
 * @property string|null $coordinate
 * @property int $status
 */
class Rental extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 0;
    const STATUS_INACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rental}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['status'], 'default', 'value' => 0],
            [['price'], 'number'],
            [['coordinate'], 'string'],
            [['name', 'city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID Пользователя',
            'name' => 'Имя',
            'price' => 'Цена',
            'city' => 'Город',
            'coordinate' => 'Координаты',
            'status' => 'Статус',
        ];
    }

    public function getRentalDescription(): \yii\db\ActiveQuery
    {
        return $this->hasOne(RentalDescription::className(), ['id_rental' => 'id']);
    }

    public function getPhoto($photo): string
    {
        $photos = preg_split('/\s+/', $photo);
        return $photos ? '/upload/' . $photos[0] : '/no-image-found-360x250.png';
    }

    public function getPhotos($photos): string
    {
        $images = '';
        foreach (preg_split('/\s+/', $photos) as $image) {
            $images .= Html::img($this->getPhoto($image), ['height' => 300, 'width' => 350, 'style' => 'margin-left : 10px; margin-top : 10px']);
        }

        return $images;
    }
}
