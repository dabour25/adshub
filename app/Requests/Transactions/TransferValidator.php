<?php

namespace App\Requests\Transactions;


use App\Requests\BaseRequestForm;


class TransferValidator extends BaseRequestForm
{

    public function rules(): array
    {
        return [
            'amount'=> 'required|numeric|min:20|max:5000',
            'password'=> 'required|min:6',
        ];
    }

}
