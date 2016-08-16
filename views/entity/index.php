<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EntitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лента сущностей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-index">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?php echo $this->render('_search', [
        'model' => $searchModel
    ]); ?>

<?php Pjax::begin(['id' => 'entities']); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'firstPageLabel' => 'Первая',
            'lastPageLabel'  => 'Последняя',
            'maxButtonCount' => 5,
        ],
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            switch ($model['type']) {
                case \app\models\Music::TYPE:
                    $type = 'music';
                    break;
                case \app\models\Film::TYPE:
                    $type = 'film';
                    break;
                case \app\models\Event::TYPE:
                    $type = 'event';
                    break;
            }
            return $this->render('_' . $type . '-item', ['item' => $model]);
        },
    ]) ?>

<?php Pjax::end(); ?>

</div>
