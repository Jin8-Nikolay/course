<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%reviews}}".
 *
 * @property int $id_rental
 * @property int $id_user
 * @property int $appraisal
 * @property string|null $text
 * @property int $date
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%reviews}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rental', 'appraisal', 'date'], 'required'],
            [['id_rental', 'id_user', 'appraisal', 'date'], 'integer'],
            [['id_user'], 'required', 'message' => 'Незарегестрированые не могут осталять отзывы.'],
            [['text'], 'string'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rental' => 'Id Rental',
            'id_user' => 'Id User',
            'appraisal' => 'Оценка',
            'text' => 'Отзыв',
            'date' => 'Date',
        ];
    }
}
