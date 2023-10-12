<?php

namespace app\models;

use yii\base\Model;

class VerifyCompatibilitySearch extends Model
{
    /** @var Number */
    public $motherboardId;
    /** @var Number */
    public $powerSupplyId;
    /** @var Number */
    public $processorId;
    /** @var Number */
    public $ramMemoryId;
    /** @var Number */
    public $ramMemoryAmount;
    /** @var Number */
    public $graphicCardId;
    /** @var Number */
    public $graphicCardAmount;
    /** @var MachineHasStorageDevice[] */
    public $storageDevices;

    public function rules()
    {
        return [
            [['motherboardId', 'powerSupplyId'], 'required'],
            [['motherboardId', 'powerSupplyId', 'processorId', 'ramMemoryId', 'ramMemoryAmount', 'graphicCardId', 'graphicCardAmount'], 'number', 'min' => 0],
            [['storageDevices'], 'safe']
        ];
    }
}
