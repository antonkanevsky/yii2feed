<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class EntitySearch extends Model
{
    public $type;
    public $createdDate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['type', 'in', 'range' => self::getEntityTypes(false)],
            ['createdDate', 'date', 'format' => 'php:Y-m-d'],
            ['createdDate', 'default', 'value' => null],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @see Model::attributeLabels()
     */
    public function attributeLabels()
    {
        return [
            'type'        => 'Тип',
            'createdDate' => 'Дата создания',
        ];
    }

    /**
     * Creates data provider instance with search query applied to all entities
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // select for music entity data
        $query1 = (new Query())
            ->select([
                'id',
                'type' => new Expression(Music::TYPE),
                'name',
                'image',
                'artist',
                'createdDate',
                'releaseDate',
                'startDate' => new Expression('NULL'),
                'endDate' => new Expression('NULL'),
            ])
            ->from(Music::tableName());

        // select for film entity data
        $query2 = (new Query())
            ->select([
                'id',
                'type' => new Expression(Film::TYPE),
                'name',
                'image',
                'artist' => new Expression('NULL'),
                'createdDate',
                'releaseDate',
                'startDate' => new Expression('NULL'),
                'endDate' => new Expression('NULL'),
            ])
            ->from(Film::tableName());

        // select for event entity data
        $query3 = (new Query())
            ->select([
                'id',
                'type' => new Expression(Event::TYPE),
                'name',
                'image',
                'artist' => new Expression('NULL'),
                'createdDate',
                'releaseDate' => new Expression('NULL'),
                'startDate',
                'endDate',
            ])
            ->from(Event::tableName());

        $query1
            ->union($query2)
            ->union($query3);

        // result query with all entities
        $query = (new Query())
            ->select('*')
            ->from(['u' => $query1])
            ->orderBy('createdDate DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // entities filtering conditions
        $query->andFilterWhere([
            'type' => $this->type,
            'DATE(createdDate)' => $this->createdDate,
        ]);

        return $dataProvider;
    }

    /**
     * Массив доступных для выбора типов сущностей
     *
     * @var boolean $indexed
     * @return array
     */
    public static function getEntityTypes($indexed = true)
    {
        $types = [
            Music::TYPE => 'Музыка',
            Film::TYPE  => 'Фильм',
            Event::TYPE => 'Событие',
        ];

        return $indexed ? $types : array_keys($types);
    }
}
