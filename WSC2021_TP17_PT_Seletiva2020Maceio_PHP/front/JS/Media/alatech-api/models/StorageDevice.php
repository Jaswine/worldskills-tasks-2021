<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "storagedevice".
 *
 * @property int $id
 * @property string $name
 * @property string $imageUrl
 * @property int $brandId
 * @property string $storageDeviceType
 * @property int $size
 * @property string $storageDeviceInterface
 *
 * @property Machinehasstoragedevice[] $machinehasstoragedevices
 * @property Machine[] $machines
 * @property Brand $brand
 */
class StorageDevice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'storagedevice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'imageUrl', 'brandId', 'storageDeviceType', 'size', 'storageDeviceInterface'], 'required'],
            [['brandId', 'size'], 'integer'],
            [['storageDeviceType', 'storageDeviceInterface'], 'string'],
            [['name'], 'string', 'max' => 96],
            [['imageUrl'], 'string', 'max' => 512],
            [['brandId'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brandId' => 'id']],
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
            'imageUrl' => 'Image Url',
            'brandId' => 'Brand ID',
            'storageDeviceType' => 'Storage Device Type',
            'size' => 'Size',
            'storageDeviceInterface' => 'Storage Device Interface',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachinehasstoragedevices()
    {
        return $this->hasMany(Machinehasstoragedevice::className(), ['storageDeviceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachines()
    {
        return $this->hasMany(Machine::className(), ['id' => 'machineId'])->viaTable('machinehasstoragedevice', ['storageDeviceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brandId']);
    }
}
