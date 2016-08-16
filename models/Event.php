<?php

namespace app\models;

use Yii;

/**
 * This is the model class for entity "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $releaseDate
 * @property string $createdDate
 */
class Event extends Entity
{
    /**
     * @const int entity type
     */
    const TYPE = 3;

    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['location', 'string', 'max' => 255],
            [['startDate', 'endDate'], 'date'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name'      => 'Название события',
            'location'  => 'Место события',
            'startDate' => 'Дата начала',
            'endDate'   => 'Дата окончания',
        ]);
    }
}