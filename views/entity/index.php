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
        <?php if ($stat['total']) {
            Modal::begin([
                'header'       => '<h2>Статистика ленты</h2>',
                'id'           => 'modalStat',
                'size'         => 'modal-md',
                'toggleButton' => [
                    'tag'   => 'a',
                    'class' => 'btn',
                    'label' => 'Статистика',
                ]
            ]);
        ?>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>Общее количество сущностей в ленте</td>
                        <td><strong><?= $stat['total'] ?></strong></td>
                    </tr>
                    <tr>
                        <td>Общее количество сущностей за сегодня</td>
                        <td><strong><?= $stat['totalToday'] ?></strong></td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td class="valign-center" rowspan="2">Общее количество сущностей за сегодня</td>
                        <td>Музыка</td>
                        <td>Фильмы</td>
                        <td>События</td>
                    </tr>
                    <tr class="text-center">
                        <td><strong><?= $stat['totalTodayByEntity']['musicCount'] ?></strong></td>
                        <td><strong><?= $stat['totalTodayByEntity']['filmCount'] ?></strong></td>
                        <td><strong><?= $stat['totalTodayByEntity']['eventCount'] ?></strong></td>
                    </tr>
                </table>
            </div>

        <?php Modal::end();

        } ?>
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
            return $this->render('_list', ['item' => $model]);
        },
    ]) ?>

<?php Pjax::end(); ?>

</div>
