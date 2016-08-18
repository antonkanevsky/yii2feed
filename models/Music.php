<?php

namespace app\models;

use Yii;

/**
 * This is the model class for entity "music".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $artist
 * @property string $releaseDate
 * @property string $createdDate
 */
class Music extends Entity
{
    /**
     * @const int entity type
     */
    const TYPE = 1;

    public static function tableName()
    {
        return 'music';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['releaseDate', 'date', 'format' => 'php:Y-m-d'],
            ['artist', 'string', 'max' => 255],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name'        => 'Название песни/музыки',
            'releaseDate' => 'Дата выхода',
            'artist'      => 'Исполнитель',
        ]);
    }
}
