<?php

namespace app\models;

use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\db\Expression;
use Yii;

/**
 * This is the base class for all entities.
 *
 * @property integer $type
 * @property string $name
 * @property string $createdDate
 * @property string $image
 */
class Entity extends ActiveRecord
{
    /**
     * Used to determine entity type
     *
     * @property integer
     */
    public $type;

    /**
     * List of available entities.
     *
     * @var boolean $indexed
     * @return array
     */
    public static function getEntityTypes($indexed = false)
    {
        $types = [
            Music::TYPE => 'Music',
            Film::TYPE  => 'Film',
            Event::TYPE => 'Event',
        ];

        return $indexed ? $types : array_keys($types);
    }

    /**
     * Return entity object.
     *
     * @param integer $type
     * @return mixed
     * @throws Exception
     */
    public static function newEntityObject($type)
    {
        if (empty($type)) {
            throw new Exception('Missing entity type param');
        }

        $types = self::getEntityTypes(true);

        if (!in_array($type, array_keys($types))) {
            throw new Exception('Unknown entity type');
        }

        $entityClassName = "app\\models\\$types[$type]";

        return new $entityClassName;
    }

    /**
     * Get total entity count.
     * @param $where additional condition
     * @return array
     */
    public static function getTotalEntityCount($where)
    {
        // select for music entity data
        $query1 = (new Query())
            ->select([
                'musicCount' => new Expression("COUNT(`id`)"),
            ])
            ->from(Music::tableName());

        // select for film entity data
        $query2 = (new Query())
            ->select([
                'filmCount' => new Expression("COUNT(`id`)"),
            ])
            ->from(Film::tableName());

        // select for event entity data
        $query3 = (new Query())
            ->select([
                'eventCount' => new Expression("COUNT(`id`)"),
            ])
            ->from(Event::tableName());

        // result query
        $query = (new Query())
            ->from([
                'musicCount' => $query1,
                'filmCount' => $query2,
                'eventCount' => $query3,
            ]);

        if ($where) {
            $query1->where($where);
            $query2->where($where);
            $query3->where($where);
        }

        return $query->all();
    }

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
     * Validate filename of entity image
     *
     * @param string $attribute
     * @param $params
     */
    public function validateImagePath($attribute, $params)
    {
        $file = Yii::getAlias('@app/web') . '/img/' . $this->$attribute;

        if (strlen($this->$attribute) && !file_exists($file)) {
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