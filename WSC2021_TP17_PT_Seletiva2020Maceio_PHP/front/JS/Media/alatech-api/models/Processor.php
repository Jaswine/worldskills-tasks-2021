<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "processor".
 *
 * @property int $id
 * @property string $name
 * @property string $imageUrl
 * @property int $brandId
 * @property int $socketTypeId
 * @property int $cores
 * @property double $baseFrequency
 * @property double $maxFrequency
 * @property double $cacheMemory
 * @property int $tdp
 *
 * @property Machine[] $machines
 * @property Sockettype $socketType
 * @property Brand $brand
 */
class Processor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'processor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'imageUrl', 'brandId', 'socketTypeId', 'cores', 'baseFrequency', 'maxFrequency', 'cacheMemory', 'tdp'], 'required'],
            [['brandId', 'socketTypeId', 'cores', 'tdp'], 'integer'],
            [['baseFrequency', 'maxFrequency', 'cacheMemory'], 'number'],
            [['name'], 'string', 'max' => 96],
            [['imageUrl'], 'string', 'max' => 512],
            [['socketTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => Sockettype::className(), 'targetAttribute' => ['socketTypeId' => 'id']],
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
            'socketTypeId' => 'Socket Type ID',
            'cores' => 'Cores',
            'baseFrequency' => 'Base Frequency',
            'maxFrequency' => 'Max Frequency',
            'cacheMemory' => 'Cache Memory',
            'tdp' => 'Tdp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachines()
    {
        return $this->hasMany(Machine::className(), ['processorId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocketType()
    {
        return $this->hasOne(Sockettype::className(), ['id' => 'socketTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brandId']);
    }
}
