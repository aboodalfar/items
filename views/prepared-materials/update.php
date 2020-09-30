<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PreparedMaterials */

$this->title = 'Update Prepared Materials: ' . $model->Preparedmaterials->name;
$this->params['breadcrumbs'][] = ['label' => 'Prepared Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Preparedmaterials->name, 'url' => ['view', 'id' => $model->Preparedmaterials->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prepared-materials-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
