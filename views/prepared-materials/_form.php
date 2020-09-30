<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 

use app\models\ItemsList;
use app\models\PreparedMaterialItems;

/* @var $this yii\web\View */
/* @var $model app\models\PreparedMaterials */
/* @var $form yii\widgets\ActiveForm */

 $product = null;
?>

<div class="prepared-materials-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false, // TODO get this working with client validation
    ]); ?>

<?= $model->errorSummary($form); ?>
    <?= $form->field($model->Preparedmaterials, 'name')->textInput(['maxlength' => true]) ?>




  <legend>Items
            <?php
            // new Item button
            echo Html::a('New Item', 'javascript:void(0);', [
              'id' => 'product-new-parcel-button', 
              'class' => 'pull-right btn btn-default btn-xs'
            ])
            ?>
        </legend>
 <?php
        $preparedMaterialItem = new PreparedMaterialItems();
$preparedMaterialItem->loadDefaultValues();
        echo '<table id="product-parcels" class="table table-condensed table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . $preparedMaterialItem->getAttributeLabel('weight') . '</th>';
        echo '<th>' . $preparedMaterialItem->getAttributeLabel('item_id') . '</th>';
        echo '<td>&nbsp;</td>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

 // existing parcels fields
        foreach ($model->preparedMaterialItems as $key => $preparedMaterialItem) {
          echo '<tr>';
          echo $this->render('_form-prepared-material-items', [
            'key' => $preparedMaterialItem->isNewRecord ? (strpos($key, 'new') !== false ? $key : 'new' . $key) : $preparedMaterialItem->id,
            'form' => $form,
            'preparedMaterialItem' => $preparedMaterialItem,
          ]);
          echo '</tr>';
        }
        
        // new Item fields
        echo '<tr id="product-new-parcel-block" style="display: none;">';
        echo $this->render('_form-prepared-material-items', [
            'key' => '__id__',
            'form' => $form,
            'preparedMaterialItem' => $preparedMaterialItem,
        ]);
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

 ?>


  <?php ob_start(); // output buffer the javascript to register later ?>
        <script>
            
            // add parcel button
            var parcel_k = <?php echo isset($key) ? str_replace('new', '', $key) : 0; ?>;
            $('#product-new-parcel-button').on('click', function () {
                parcel_k += 1;
                $('#product-parcels').find('tbody')
                  .append('<tr>' + $('#product-new-parcel-block').html().replace(/__id__/g, 'new' + parcel_k) + '</tr>');
            });
            
            // remove parcel button
            $(document).on('click', '.product-remove-parcel-button', function () {
                $(this).closest('tbody tr').remove();
            });
            
            <?php
            // OPTIONAL: click add when the form first loads to display the first new row
/*
            if (!Yii::$app->request->isPost && $model->product->isNewRecord) 
              echo "$('#product-new-parcel-button').click();";
*/
            ?>
        </script>
        <?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean())); ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
