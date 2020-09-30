<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Items List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'unit_id',
            'name',
            'weight',
            'price',
            //'unit_price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
