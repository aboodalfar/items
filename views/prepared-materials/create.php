<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PreparedMaterials */

$this->title = 'Create Prepared Materials';
$this->params['breadcrumbs'][] = ['label' => 'Prepared Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prepared-materials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
