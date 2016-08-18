<?php

namespace app\models;

use Yii;

/**
 * This is the model class for entity "film".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $releaseDate
 * @property string $createdDate
 */
class Film extends Entity
{
    /**
     * @const int entity type
     */
    const TYPE = 2;

    public static function tableName()
    {
        return 'film';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['releaseDate', 'date', 'format' => 'php:Y-m-d'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Название фильма',
            'releaseDate' => 'Дата выхода',
        ]);
    }
}
