<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MotherBoardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'imageUrl' => $this->imageUrl,
            'brand' => $this->brandId,
            'socketType' => $this->socketTypeId,
            'RAMMemoryType' => $this->ramMemoryTypeId,
            'ramMemorySlots' => $this->ramMemorySlots,
            'maxTdp' => $this->maxTdp,
            'sataSlots' => $this->sataSlots,
            'm2Slots' => $this->m2Slots,
            'pciSlots' => $this->pciSlots,
        ];
    }
}
