<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "graphiccard".
 *
 * @property int $id
 * @property string $name
 * @property string $imageUrl
 * @property int $brandId
 * @property int $memorySize
 * @property string $memoryType
 * @property int $minimumPowerSupply
 * @property int $supportMultiGpu
 *
 * @property Brand $brand
 * @property Machine[] $machines
 */
class GraphicCard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graphiccard';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'imageUrl', 'brandId', 'memorySize', 'memoryType', 'minimumPowerSupply', 'supportMultiGpu'], 'required'],
            [['brandId', 'memorySize', 'minimumPowerSupply', 'supportMultiGpu'], 'integer'],
            [['memoryType'], 'string'],
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
            'memorySize' => 'Memory Size',
            'memoryType' => 'Memory Type',
            'minimumPowerSupply' => 'Minimum Power Supply',
            'supportMultiGpu' => 'Support Multi Gpu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brandId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachines()
    {
        return $this->hasMany(Machine::className(), ['graphicCardId' => 'id']);
    }
}
