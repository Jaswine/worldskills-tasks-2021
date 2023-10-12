<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "machine".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $imageUrl
 * @property int $motherboardId
 * @property int $processorId
 * @property int $ramMemoryId
 * @property int $ramMemoryAmount
 * @property int $graphicCardId
 * @property int $graphicCardAmount
 * @property int $powerSupplyId
 *
 * @property Motherboard $motherboard
 * @property Processor $processor
 * @property RamMemory $ramMemory
 * @property GraphicCard $graphicCard
 * @property Powersupply $powerSupply
 * @property MachineHasStorageDevice[] $machineHasStorageDevices
 * @property StorageDevice[] $storageDevices
 */
class Machine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'machine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'motherboardId', 'processorId', 'ramMemoryId', 'ramMemoryAmount', 'graphicCardId', 'graphicCardAmount', 'powerSupplyId'], 'required'],
            [['motherboardId', 'processorId', 'ramMemoryId', 'ramMemoryAmount', 'graphicCardId', 'graphicCardAmount', 'powerSupplyId'], 'integer'],
            [['name'], 'string', 'max' => 96],
            [['description'], 'string', 'max' => 512],
            [['motherboardId'], 'exist', 'skipOnError' => true, 'targetClass' => Motherboard::className(), 'targetAttribute' => ['motherboardId' => 'id']],
            [['processorId'], 'exist', 'skipOnError' => true, 'targetClass' => Processor::className(), 'targetAttribute' => ['processorId' => 'id']],
            [['ramMemoryId'], 'exist', 'skipOnError' => true, 'targetClass' => RamMemory::className(), 'targetAttribute' => ['ramMemoryId' => 'id']],
            [['graphicCardId'], 'exist', 'skipOnError' => true, 'targetClass' => Graphiccard::className(), 'targetAttribute' => ['graphicCardId' => 'id']],
            [['powerSupplyId'], 'exist', 'skipOnError' => true, 'targetClass' => Powersupply::className(), 'targetAttribute' => ['powerSupplyId' => 'id']],
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
            'description' => 'Description',
            'imageUrl' => 'Image Url',
            'motherboardId' => 'Motherboard ID',
            'processorId' => 'Processor ID',
            'ramMemoryId' => 'Ram Memory ID',
            'ramMemoryAmount' => 'Ram Memory Amount',
            'graphicCardId' => 'Graphic Card ID',
            'graphicCardAmount' => 'Graphic Card Amount',
            'powerSupplyId' => 'Power Supply ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotherboard()
    {
        return $this->hasOne(Motherboard::className(), ['id' => 'motherboardId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessor()
    {
        return $this->hasOne(Processor::className(), ['id' => 'processorId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRamMemory()
    {
        return $this->hasOne(RamMemory::className(), ['id' => 'ramMemoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGraphicCard()
    {
        return $this->hasOne(GraphicCard::className(), ['id' => 'graphicCardId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPowerSupply()
    {
        return $this->hasOne(PowerSupply::className(), ['id' => 'powerSupplyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachineHasStorageDevices()
    {
        return $this->hasMany(MachineHasStorageDevice::className(), ['machineId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorageDevices()
    {
        return $this->hasMany(StorageDevice::className(), ['id' => 'storageDeviceId'])->viaTable('machinehasstoragedevice', ['machineId' => 'id']);
    }
}
