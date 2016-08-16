<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\EntitySearch;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EntitySearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#entity-search-pjax").on("pjax:end", function() {debugger
            $.pjax.reload({container:"#entities"});  //Reload GridView
        });
    });'
);
?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Фильтры раздела</h3>
        </div>
        <div class="panel-body">
            <div class="entity-search-form">

                <?php Pjax::begin(['id' => 'entity-search-pjax']) ?>
                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    'layout' => 'horizontal',
                    'options' => ['data-pjax' => true],
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-2',
                            'wrapper' => 'col-sm-10',
                        ],
                    ],
                ]); ?>

                <?= $form->field($model, 'type')
                    ->label($model->getAttributeLabel('type'))
                    ->dropDownList(EntitySearch::getEntityTypes(), ['prompt' => '']) ?>

                <?= $form->field($model, 'createdDate')
                    ->widget(DatePicker::classname(), [
                        'pluginOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'format'    => 'yyyy-mm-dd'
                        ]
                    ]); ?>

                <div class="form-group buttons">
                    <?= Html::submitButton('Применить фильтры', ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton('Сбросить фильтры', ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

</div>