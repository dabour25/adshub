<?php

namespace App\Requests\Requests;


use App\Requests\BaseRequestForm;
use Illuminate\Support\Facades\Auth;


class CreateRequestValidator extends BaseRequestForm
{

    public function rules(): array
    {
        $type=$this->request()->type??null;
        $balance=Auth::user()->balance;
        if($type=='deposit'){
            return [
                'type'=> 'required|in:deposit,withdraw',
                'amount'=> 'required|numeric|min:20|max:3000',
                'method'=> 'required|min:5|in:vf_cash,paypal',
            ];
        }else{
            if($balance>1000){
                return [
                    'type'=> 'required|in:deposit,withdraw',
                    'amount'=> 'required|numeric|min:50|max:1000',
                    'method'=> 'required|min:5|in:vf_cash,paypal',
                ];
            }else{
                return [
                    'type'=> 'required|in:deposit,withdraw',
                    'amount'=> 'required|numeric|min:50|max:'.$balance,
                    'method'=> 'required|min:5|in:vf_cash,paypal',
                ];
            }

        }

    }

}
