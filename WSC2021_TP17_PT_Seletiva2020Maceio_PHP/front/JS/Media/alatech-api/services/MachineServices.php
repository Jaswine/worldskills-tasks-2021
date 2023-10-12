<?php

namespace app\services;

use app\models\GraphicCard;
use app\models\Machine;
use app\models\MachineHasStorageDevice;
use app\models\Motherboard;
use app\models\PowerSupply;
use app\models\Processor;
use app\models\RamMemory;

class MachineServices
{
    /**
     * @param Machine $machine
     * @param MachineHasStorageDevice[] $storageDevices
     * @return array
     */
    public function validateWholeMachine($machine, $storageDevices)
    {
        /** @var Motherboard $motherboard */
        $motherboard = $machine->getMotherboard()->one();
        /** @var Processor $processor */
        $processor = $machine->getProcessor()->one();
        /** @var RamMemory $ramMemory */
        $ramMemory = $machine->getRamMemory()->one();
        /** @var Number $ramMemoryAmount */
        $ramMemoryAmount = $machine->ramMemoryAmount;
        /** @var GraphicCard $graphicCard */
        $graphicCard = $machine->getGraphicCard()->one();
        /** @var Number $graphicCardAmount */
        $graphicCardAmount = $machine->graphicCardAmount;
        /** @var PowerSupply $powerSupply */
        $powerSupply = $machine->getPowerSupply()->one();
        //
        $sataStorageDevices = array_filter(
            $storageDevices,
            /**
             * @param MachineHasStorageDevice $item
             * @return bool
             */
            function($item)
            {
                return $item->storageDevice->storageDeviceInterface == 'sata';
            }
        );
        $totalSataDevices = array_sum(
            array_map(
                function($item) { return $item->amount; },
                $sataStorageDevices
            )
        );
        $m2StorageDevices = array_filter(
            $storageDevices,
            /**
             * @param MachineHasStorageDevice $item
             * @return bool
             */
            function($item)
            {
                return $item->storageDevice->storageDeviceInterface == 'm2';
            }
        );
        $totalM2Devices = array_sum(
            array_map(
                function($item) { return $item->amount; },
                $m2StorageDevices
            )
        );
        // Power Supply
        if($powerSupply == null)
        {
            $machine->addError('powerSupplyId', 'No power supply selected');
        }
        else
        {
            // Graphic card
            if($graphicCardAmount > 0 && $graphicCard != null)
            {
                if($graphicCard->minimumPowerSupply * $graphicCardAmount > $powerSupply->potency)
                {
                    $machine->addError('powerSupply', 'The total potency of all graphic cards selected is higher than power supply potency');
                }
            }
        }
        // Motherboard
        if($motherboard == null)
        {
            $machine->addError('motherboardId', 'No motherboard selected');
        }
        else
        {
            // Processor
            if($processor == null)
            {
                $machine->addError('processorId', 'No processor selected');
            }
            else if($processor->socketTypeId != $motherboard->socketTypeId)
            {
                $machine->addError('processorId', 'Processor socket doesn\'t match motherboard socket');
            }
            else if($processor->tdp > $motherboard->maxTdp)
            {
                $machine->addError('processorId', 'Processor TDP is higher than motherboard\'s max TDP');
            }
            // RAM Memory
            if($ramMemory == null)
            {
                $machine->addError('ramMemoryId', 'No RAM memory selected');
            }
            else if($ramMemory->ramMemoryTypeId != $motherboard->ramMemoryTypeId)
            {
                $machine->addError('ramMemoryId', 'RAM memory type doesn\'t match motherboard\'s RAM memory type');
            }
            else if($ramMemoryAmount <= 0)
            {
                $machine->addError('ramMemoryId', 'There must be at least one RAM memory in machine');
            }
            else if($ramMemoryAmount > $motherboard->ramMemorySlots)
            {
                $machine->addError('ramMemoryId', 'There are more RAM memories than available slots in motherboard');
            }
            // Graphic card
            if($graphicCard == null)
            {
                $machine->addError('graphicCardId', 'No graphic card selected');
            }
            else if($graphicCardAmount == 0)
            {
                $machine->addError('graphicCardId', 'There must be at least one graphic card in machine');
            }
            else if($graphicCardAmount > 1 && !$graphicCard->supportMultiGpu)
            {
                $machine->addError('graphicCardId', 'The selected graphic card doesn\'t support multi GPU');
            }
            else if($graphicCardAmount > $motherboard->pciSlots)
            {
                $machine->addError('graphicCardId', 'There are more graphic cards than available PCI slots in motherboard');
            }
            // Storage devices
            if(($totalM2Devices + $totalSataDevices) == 0)
            {
                $machine->addError('storageDevices', 'There must be at least one storage device in machine');
            }
            else
            {
                if($totalSataDevices > $motherboard->sataSlots)
                {
                    $machine->addError('storageDevices', 'There are more SATA storage devices than available SATA slots in motherboard');
                }
                if($totalM2Devices > $motherboard->m2Slots)
                {
                    $machine->addError('storageDevices', 'There are more M2 storage devices than available M2 slots in motherboard');
                }
            }
        }
        return $machine->errors;
    }

    /**
     * @param Number $motherboardId
     * @param Number $processorId
     * @param Number $ramMemoryId
     * @param Number $ramMemoryAmount
     * @param Number $graphicCardId
     * @param Number $graphicCardAmount
     * @param Number $powerSupplyId
     * @param MachineHasStorageDevice[] $storageDevices
     * @return array
     */
    public function validateCompabilitity($motherboardId, $processorId, $ramMemoryId, $ramMemoryAmount, $graphicCardId, $graphicCardAmount, $powerSupplyId, $storageDevices)
    {
        $machine = new Machine();
        $machine->motherboardId = $motherboardId;
        $machine->processorId = $processorId;
        $machine->ramMemoryId = $ramMemoryId;
        $machine->ramMemoryAmount = $ramMemoryAmount;
        $machine->graphicCardId = $graphicCardId;
        $machine->graphicCardAmount = $graphicCardAmount;
        $machine->powerSupplyId = $powerSupplyId;
        /** @var Motherboard $motherboard */
        $motherboard = $machine->getMotherboard()->one();
        /** @var Processor $processor */
        $processor = $machine->getProcessor()->one();
        /** @var RamMemory $ramMemory */
        $ramMemory = $machine->getRamMemory()->one();
        /** @var Number $ramMemoryAmount */
        $ramMemoryAmount = $machine->ramMemoryAmount;
        /** @var GraphicCard $graphicCard */
        $graphicCard = $machine->getGraphicCard()->one();
        /** @var Number $graphicCardAmount */
        $graphicCardAmount = $machine->graphicCardAmount;
        /** @var PowerSupply $powerSupply */
        $powerSupply = $machine->getPowerSupply()->one();
        $sataStorageDevices = array_filter(
            $storageDevices,
            /**
             * @param MachineHasStorageDevice $item
             * @return bool
             */
            function($item)
            {
                return $item->storageDevice->storageDeviceInterface == 'sata';
            }
        );
        $totalSataDevices = array_sum(
            array_map(
                function($item) { return $item->amount; },
                $sataStorageDevices
            )
        );
        $m2StorageDevices = array_filter(
            $storageDevices,
            /**
             * @param MachineHasStorageDevice $item
             * @return bool
             */
            function($item)
            {
                return $item->storageDevice->storageDeviceInterface == 'm2';
            }
        );
        $totalM2Devices = array_sum(
            array_map(
                function($item) { return $item->amount; },
                $m2StorageDevices
            )
        );
        // Power Supply
        if($powerSupply == null)
        {
            $machine->addError('powerSupplyId', 'No power supply selected');
        }
        else
        {
            // Graphic card
            if($graphicCardAmount > 0 && $graphicCard != null)
            {
                if($graphicCard->minimumPowerSupply * $graphicCardAmount > $powerSupply->potency)
                {
                    $machine->addError('powerSupply', 'The total potency of all graphic cards selected is higher than power supply potency');
                }
            }
        }
        // Motherboard
        if($motherboard == null)
        {
            $machine->addError('motherboardId', 'No motherboard selected');
        }
        else
        {
            // Processor
            if($processor != null)
            {
                if($processor->socketTypeId != $motherboard->socketTypeId)
                {
                    $machine->addError('processorId', 'Processor socket doesn\'t match motherboard socket');
                }
                else if($processor->tdp > $motherboard->maxTdp)
                {
                    $machine->addError('processorId', 'Processor TDP is higher than motherboard\'s max TDP');
                }
            }
            // RAM Memory
            if($ramMemory != null)
            {
                if($ramMemory->ramMemoryTypeId != $motherboard->ramMemoryTypeId)
                {
                    $machine->addError('ramMemoryId', 'RAM memory type doesn\'t match motherboard\'s RAM memory type');
                }
                else if($ramMemoryAmount <= 0)
                {
                    $machine->addError('ramMemoryId', 'There must be at least one RAM memory in machine');
                }
                else if($ramMemoryAmount > $motherboard->ramMemorySlots)
                {
                    $machine->addError('ramMemoryId', 'There are more RAM memories than available slots in motherboard');
                }
            }
            // Graphic card
            if($graphicCard != null)
            {
                if($graphicCardAmount == 0)
                {
                    $machine->addError('graphicCardId', 'There must be at least one graphic card in machine');
                }
                else if($graphicCardAmount > 1 && !$graphicCard->supportMultiGpu)
                {
                    $machine->addError('graphicCardId', 'The selected graphic card doesn\'t support multi GPU');
                }
                else if($graphicCardAmount > $motherboard->pciSlots)
                {
                    $machine->addError('graphicCardId', 'There are more graphic cards than available PCI slots in motherboard');
                }
            }
            // Storage devices
            if(sizeof($storageDevices) != 0)
            {
                if($totalSataDevices > $motherboard->sataSlots)
                {
                    $machine->addError('storageDevices', 'There are more SATA storage devices than available SATA slots in motherboard');
                }
                if($totalM2Devices > $motherboard->m2Slots)
                {
                    $machine->addError('storageDevices', 'There are more M2 storage devices than available M2 slots in motherboard');
                }
            }
        }
        return $machine->errors;
    }

    public function uploadMachineImageFromBase64(Machine $model, String $imageBase64)
    {
        $fileName = md5(date('c'));
        $filePath = \Yii::getAlias('@app/uploads/images/' . $fileName . '.png');
        $base64SeparatorIndex = strpos($imageBase64, 'base64,');
        if($base64SeparatorIndex === false) $base64SeparatorIndex = 0;
        else $base64SeparatorIndex += strlen('base64,');
        $imageBase64Only = substr($imageBase64, $base64SeparatorIndex);
        $imageBinary = base64_decode($imageBase64Only);
        $fileResource = fopen($filePath,'w+');
        fwrite($fileResource, $imageBinary);
        fclose($fileResource);
        return $fileName;
    }

    public function deleteMachineImage(Machine $model)
    {
        $filePath = \Yii::getAlias('@app/uploads/images/' . $model->imageUrl . '.png');
        if(file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
        }
    }

    public function getImageFromId($id)
    {
        $filePath = \Yii::getAlias('@app/uploads/images/' . $id . '.png');
        if(file_exists($filePath) && is_file($filePath)) {
            return file_get_contents($filePath);
        }
        return false;
    }

    public function getImagePathFromId($id)
    {
        return $filePath = \Yii::getAlias('@app/uploads/images/' . $id . '.png');
    }
}
