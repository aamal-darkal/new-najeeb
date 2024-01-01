<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public static $wrap = null;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {        
        return [
            'payment_id' => $this->id ,
            'student_id' => $this->order->student->id,
            'amount' => $this->amount,
            'bill_number' =>$this->bill_number,
            'payment_date' => $this->payment_date,          
        ];
    }

}
