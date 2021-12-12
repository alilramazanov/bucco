<?php

namespace App\Http\Resources\Accounting;

use App\Http\Repositories\Accounting\CategoryProductRepository;
use App\Models\CategoryProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailExpenseResource extends JsonResource
{

    public function toArray($request)
    {








        return [

            'id' => $this->id,
            'expenseCategoryName' => $this->expenseCategory->name,
            'name' => $this->name,
            'dateOfDebiting' => $this->date_of_debiting,
            'paymentAmount' => $this->payment_amount,
            'isPaid' => $this->is_paid,
            'group_id' => $this->group_id

        ];
    }
}
