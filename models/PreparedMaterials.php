<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prepared_materials".
 *
 * @property int $id
 * @property string $name
 */
class PreparedMaterials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prepared_materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
    public function getPreparedMaterialItems()
    {
        return $this->hasMany(PreparedMaterialItems::className(), ['material_id' => 'id']);
    }


   
}
