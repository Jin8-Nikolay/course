<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%rental_description}}".
 *
 * @property int $id_rental
 * @property string|null $photos
 * @property string|null $description
 * @property string|null $conditions
 * @property string|null $notes
 */
class RentalDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rental_description}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rental'], 'required'],
            [['id_rental'], 'integer'],
            [['description', 'conditions', 'notes'], 'string'],
            [['photos'], 'string'],
        ];
    }
    public static function primaryKey()
    {
        return ['id_rental'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rental' => 'Id Rental',
            'photos' => 'Фотки',
            'description' => 'Описание',
            'conditions' => 'Условия',
            'notes' => 'Заметки',
        ];
    }

    public function getRental(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Rental::className(), ['id' => 'id_rental']);
    }
}
