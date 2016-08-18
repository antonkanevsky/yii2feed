<?php

use app\models\Entity;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EntitySearch */
/* @var $form yii\bootstrap\ActiveForm */
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
                            'label'   => 'col-sm-2 col-md-2',
                            'wrapper' => 'col-sm-10 col-md-8',
                        ],
                    ],
                ]); ?>

                <?= $form->field($model, 'type')
                    ->label($model->getAttributeLabel('type'))
                    ->dropDownList(Entity::getEntityTypes(true), ['prompt' => '']) ?>

                <?= $form->field($model, 'createdDate')
                    ->widget(DatePicker::classname(), [
                        'pluginOptions' => [
                            'autoclose'      => true,
                            'format'         => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                        ]
                    ]); ?>

                <div class="form-group buttons">
                    <?= Html::submitButton('Применить фильтры', ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton('Сбросить фильтры', ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>

            </div>
        </div>
    </div>

</div>

<?php
$script = <<< JS
    $("document").ready(function(){
        $("#entity-search-pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#entities"});
        });
    });
JS;
$this->registerJs($script);
?>