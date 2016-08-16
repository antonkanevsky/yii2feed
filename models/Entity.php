<?php

namespace app\models;

use Yii;

/**
 * This is the abstract model class for all entities.
 *
 * @property integer $type
 */
abstract class Entity extends \yii\db\ActiveRecord
{
    /**
     * Used to determine entity type
     *
     * @property integer
     */
    public $type;

    /**
     * @see ActiveRecord::rules()
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['createdDate'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            ['image', 'validateImagePath']
        ];
    }

    /**
     * Проверка на существование файла обложки сущности
     *
     * @param string $attribute
     * @param $params
     */
    public function validateImagePath($attribute, $params)
    {
        if (strlen($this->$attribute) && !file_exists($this->$attribute)) {
            $this->addError($attribute, 'Неверный путь к файлу обложки');
        }
    }

    /**
     * @see ActiveRecord::attributeLabels()
     */
    public function attributeLabels()
    {
        return [
            'createdDate' => 'Дата публикации',
        ];
    }
}