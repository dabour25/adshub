<?php

namespace App\Requests\Transactions;


use App\Requests\BaseRequestForm;


class TransferValidator extends BaseRequestForm
{

    public function rules(): array
    {
        return [
            'amount'=> 'required|numeric|min:0.1|max:999999',
            'password'=> 'required|min:6',
        ];
    }

}
