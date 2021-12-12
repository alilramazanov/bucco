<?php

namespace App\Http\Resources\Accounting;

use App\Http\Repositories\Accounting\CategoryProductRepository;
use App\Models\CategoryProduct;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ListExpenseResource extends JsonResource
{

    protected function day ($number){
        switch ($number){
            case in_array($number % 10, [0,1]):
                return 'день';
            case in_array($number % 10, [5,6,7,8,9]):
                return 'дней';
            case in_array($number % 10, [2,3,4]):
                return 'дня';
        }
    }



    public function toArray($request)
    {


        $paymentDay = Carbon::parse($this->date_of_debiting)->diffInDays($this->created_at);


        return[
            'name' => $this->name,
            'data' => $this->is_paid == true ? 'оплачено' : $paymentDay . " " . $this->day($paymentDay)
        ];
    }

}
