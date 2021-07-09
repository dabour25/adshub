<?php

namespace App\Requests\Transactions;


use App\Requests\BaseRequestForm;


class CreateTransactionValidator extends BaseRequestForm
{

    public function rules(): array
    {
        return [
            'user_id'=> 'required|max:50',
            'transaction_type'=> 'required',
            'amount'=> 'required|numeric|min:0|max:999999',
            'comment'=> 'required|min:5',
        ];
    }

}
