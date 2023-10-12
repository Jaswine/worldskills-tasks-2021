<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string $name
 *
 * @property Graphiccard[] $graphiccards
 * @property Motherboard[] $motherboards
 * @property Powersupply[] $powersupplies
 * @property Processor[] $processors
 * @property RamMemory[] $rammemories
 * @property StorageDevice[] $storagedevices
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 96],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGraphiccards()
    {
        return $this->hasMany(Graphiccard::className(), ['brandId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotherboards()
    {
        return $this->hasMany(Motherboard::className(), ['brandId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPowersupplies()
    {
        return $this->hasMany(Powersupply::className(), ['brandId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessors()
    {
        return $this->hasMany(Processor::className(), ['brandId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRammemories()
    {
        return $this->hasMany(RamMemory::className(), ['brandId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoragedevices()
    {
        return $this->hasMany(StorageDevice::className(), ['brandId' => 'id']);
    }
}
