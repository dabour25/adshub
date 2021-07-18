<?php

namespace App\Requests;

use App\Requests\BaseRequestForm;

class UpdateUserValidator extends BaseRequestForm
{
    
    public function rules(): array
    {
        $slug=$this->request()->segment(3);
        return [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users,email,'.$slug.',slug|min:5|max:50',
            'phone' => 'required|min:11|max:13|unique:users,phone,'.$slug.',slug',
            'paypal_email'=>'nullable|min:5|max:50|email|unique:users,paypal_email,'.$slug.',slug',
            'user_status'=>'required|in:active,admin,blocked',
        ];
    }

    public function authorized(): bool
    {
       return true;
    }
}
