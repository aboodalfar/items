<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items_list".
 *
 * @property int $id
 * @property int|null $unit_id
 * @property string $name
 * @property string|null $weight
 * @property float|null $price
 * @property float|null $unit_price
 */
class ItemsList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id'], 'integer'],
            [['name'], 'required'],
            [['price', 'unit_price'], 'number'],
            [['name', 'weight'], 'string', 'max' => 30],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Units::className(), 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_id' => 'Unit ID',
            'name' => 'Name',
            'weight' => 'Weight',
            'price' => 'Price',
            'unit_price' => 'Unit Price',
        ];
    }

    public function getUnit(){
       return "TODO : get name of unit";
    }
}
