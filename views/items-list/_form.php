<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use app\models\Units;
/* @var $this yii\web\View */
/* @var $model app\models\ItemsList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-list-form">

    <?php $form = ActiveForm::begin(); ?>

  

      <?= $form->field($model, 'unit_id')->dropDownList(
            ArrayHelper::map(Units::find()->all(),'id','name'),
            ['prompt'=>'Select Unit']
       )?> 

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
