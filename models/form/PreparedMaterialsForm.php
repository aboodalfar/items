<?php
namespace app\models\form;

use app\models\PreparedMaterials;
use app\models\PreparedMaterialItems;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;
//https://mrphp.com.au/blog/advanced-multi-hasmany-model-forms-yii2/
class PreparedMaterialsForm extends Model
{
    private $_preparedMaterials;
    private $_preparedMaterialItems;

    public function rules()
    {
        return [
            [['PreparedMaterials'], 'required'],
            [['PreparedMaterialItems'], 'safe'],
        ];
    }

    public function afterValidate()
    {

        if (!Model::validateMultiple($this->getAllModels())) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->PreparedMaterials->save()) {
            $transaction->rollBack();
            return false;
        }
        if (!$this->savePreparedMaterialItems()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }
    
    public function savePreparedMaterialItems() 
    {
        $keep = [];

        foreach ($this->preparedMaterialItems as $preparedMaterialItem) {
            $preparedMaterialItem->material_id = $this->preparedMaterials->id;
            if (!$preparedMaterialItem->save(false)) {
                return false;
            }
            $keep[] = $preparedMaterialItem->id;
        }
        $query = PreparedMaterialItems::find()->andWhere(['material_id' => $this->preparedMaterials->id]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $preparedMaterialItem) {
            $preparedMaterialItem->delete();
        }        
        return true;
    }

    public function getPreparedMaterials()
    {
        return $this->_preparedMaterials;
    }

    public function setPreparedMaterials($preparedMaterials)
    {

        if ($preparedMaterials instanceof PreparedMaterials) {
            $this->_preparedMaterials = $preparedMaterials;
        } else if (is_array($preparedMaterials)) {
            $this->_preparedMaterials->setAttributes($preparedMaterials);
        }
    }

    public function getPreparedMaterialItems()
    {
        if ($this->_preparedMaterialItems === null) {
            $this->_preparedMaterialItems = $this->PreparedMaterials->isNewRecord ? [] : $this->PreparedMaterials->preparedMaterialItems;
        }
        return $this->_preparedMaterialItems;
    }

    private function getPreparedMaterialItem($key)
    {
        $parcel = $key && strpos($key, 'new') === false ? PreparedMaterialItems::findOne($key) : false;
        if (!$parcel) {
            $parcel = new PreparedMaterialItems();
            $parcel->loadDefaultValues();
        }
        return $parcel;
    }

    public function setPreparedMaterialItems($preparedMaterialItems)
    {

        unset($preparedMaterialItems['__id__']); // remove the hidden "new Parcel" row
        $this->_preparedMaterialItems = [];
        foreach ($preparedMaterialItems as $key => $preparedMaterialItem) {

            if (is_array($preparedMaterialItem)) {
                $this->_preparedMaterialItems[$key] = $this->getPreparedMaterialItem($key);
                $this->_preparedMaterialItems[$key]->setAttributes($preparedMaterialItem);
            } elseif ($preparedMaterialItem instanceof PreparedMaterialItems) {
                $this->_preparedMaterialItems[$preparedMaterialItem->id] = $preparedMaterialItem;
            }
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
              'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        $models = [
            'PreparedMaterials' => $this->_preparedMaterials,
        ];

        foreach ($this->preparedMaterialItems as $id => $parcel) {
            $models['PreparedMaterialItems.' . $id] = $this->preparedMaterialItems[$id];
        }
        return $models;
    }
}

