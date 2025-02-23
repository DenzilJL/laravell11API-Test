<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => encrypt($this->id),
            'customerId' => encrypt($this->customer_id),
            'title' => $this->title,
            'description' => $this->description,
            'amount' => $this->amount,
            'status' => $this->status,
            'active' => $this->active,
            'paidDate' => $this->paid_date,
            'billedDate' => $this->billed_date,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}

