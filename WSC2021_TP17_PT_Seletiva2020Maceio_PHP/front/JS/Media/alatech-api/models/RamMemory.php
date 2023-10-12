<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rammemory".
 *
 * @property int $id
 * @property string $name
 * @property string $imageUrl
 * @property int $brandId
 * @property int $size
 * @property int $ramMemoryTypeId
 * @property double $frequency
 *
 * @property Machine[] $machines
 * @property Rammemorytype $ramMemoryType
 * @property Brand $brand
 */
class RamMemory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rammemory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'imageUrl', 'brandId', 'size', 'ramMemoryTypeId', 'frequency'], 'required'],
            [['brandId', 'size', 'ramMemoryTypeId'], 'integer'],
            [['frequency'], 'number'],
            [['name'], 'string', 'max' => 96],
            [['imageUrl'], 'string', 'max' => 512],
            [['ramMemoryTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => Rammemorytype::className(), 'targetAttribute' => ['ramMemoryTypeId' => 'id']],
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
            'size' => 'Size',
            'ramMemoryTypeId' => 'Ram Memory Type ID',
            'frequency' => 'Frequency',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachines()
    {
        return $this->hasMany(Machine::className(), ['ramMemoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRamMemoryType()
    {
        return $this->hasOne(Rammemorytype::className(), ['id' => 'ramMemoryTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brandId']);
    }
}
