<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prepared_material_items".
 *
 * @property int $id
 * @property int $item_id
 * @property int $material_id
 */
class PreparedMaterialItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prepared_material_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id'], 'required'],
            //[['material_id'], 'required'],
            [['weight'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item',
            'material_id' => 'material',
            'weight' => 'weight',
        ];
    }

    public function getPreparedMaterials()
    {
        return $this->hasOne(PreparedMaterials::className(), ['id' => 'material_id']);
    }

}
