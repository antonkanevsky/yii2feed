<?php

namespace app\controllers;

use Yii;
use app\models\EntitySearch;
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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
