<?php
use app\models\Parcel;
use yii\helpers\Html;
use yii\helpers\ArrayHelper; 
use app\models\ItemsList;
?>
<td>
    <?= $form->field($preparedMaterialItem, 'weight')->textInput([
        'id' => "PreparedMaterialItems_{$key}_weight",
        'name' => "PreparedMaterialItems[$key][weight]",
    ])->label(false) ?>
</td>
<td>

<?= $form->field($preparedMaterialItem, 'item_id')->dropDownList(
            ArrayHelper::map(ItemsList::find()->all(),'id','name'),
            [
		'prompt'=>'Select Item',
                'id' => "PreparedMaterialItems_{$key}_item_id",
                'name' => "PreparedMaterialItems[$key][item_id]",
	    ]
       )?> 
</td>

<td>
    <?= Html::a('Remove ' . $key, 'javascript:void(0);', [
      'class' => 'product-remove-parcel-button btn btn-default btn-xs',
    ]) ?>
</td>

