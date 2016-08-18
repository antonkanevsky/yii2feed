<?php

namespace app\commands;

use yii\console\Controller;
use yii\base\Exception;
use app\models\Entity;
use Yii;

/**
 * EntityController implements action for entities in console application.
 */
class EntityController extends Controller
{
    /**
     * Maximum interval for creating one entity.
     * @const integer
     */
    const MAX_INTERVAL = 30;

    /**
     * Default interval for creating one entity.
     * @const integer
     */
    const DEFAULT_INTERVAL = 10;

    /**
     * Generates entity each $interval seconds. Default value is 10 seconds.
     * Example of running command: yii entity | yii entity 5
     *
     * @param integer $interval
     * @return integer
     */
    public function actionIndex($interval = self::DEFAULT_INTERVAL)
    {
        if (!is_int($interval)) {
            $interval = (int)$interval;
        }

        if ($interval <= 0) {
            $this->stdout('Please, enter positive integer value for interval.');
            print PHP_EOL;
            exit(1);
        }
        // avoid setting too big intervals
        if ($interval > self::MAX_INTERVAL) {
            $interval = self::MAX_INTERVAL;
        }

        // getting data for further generating
        $xmlData = $this->getXmlData(Yii::getAlias('@app/web')
            . '/xml/entity_data.xml');

        // total count in xml
        $cnt = count($xmlData);
        set_time_limit(0);

        // keep generating until pressing CTRL+C
        while (true) {
            $randomIndex = rand(0, $cnt-1);
            $entityData = $xmlData[$randomIndex];
            /** @var Entity $entity */
            $entity = Entity::newEntityObject($entityData['type']);
            $entity->attributes = $entityData;
            $entity->insert();
            // delay for generating each new entity
            usleep($interval * 1000000);
        }
    }

    /**
     * Get xml data from file as array.
     *
     * @param string $file
     *
     * @return array
     * @throws Exception
     */
    protected function getXmlData($file)
    {
        if (!$file) {
            throw new Exception('Missing required file param');
        }

        if (!file_exists($file)) {
            throw new Exception('Failed to open file');
        }

        libxml_use_internal_errors(true);

        $result = simplexml_load_file($file, 'SimpleXMLElement');

        if ($result === false) {
            $errors = libxml_get_errors();
            $latestError = array_pop($errors);

            throw new Exception($latestError->message);
        }

        $result = json_decode(json_encode($result), true);

        return $result['entity'];
    }
}