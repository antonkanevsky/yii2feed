<?php

namespace app\controllers;

use Yii;
use app\models\EntitySearch;
use app\models\Entity;
use yii\db\Expression;
use yii\web\Controller;

/**
 * EntityController implements action for displaying and filtering entities.
 */
class EntityController extends Controller
{
    /**
     * Lists all entities.
     * Allowed for registered users.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(Url::to(['site/login']));
        }

        $searchModel = new EntitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $totalsByEntity = Entity::getTotalEntityCount([
            'DATE(createdDate)' => new Expression('CURDATE()')
        ]);

        $totalToday = array_sum($totalsByEntity[0]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'stat' => [
                'total' => $dataProvider->getTotalCount(),
                'totalToday' => $totalToday,
                'totalTodayByEntity' => $totalsByEntity[0],
            ]
        ]);
    }
}