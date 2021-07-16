<?php

namespace App\Requests;

use App\Requests\BaseRequestForm;

class ChangePasswordValidator extends BaseRequestForm
{
    
    public function rules(): array
    {
        
        return [
            'old_password' => 'required',
            'password'=>'required|min:6|confirmed',
        ];
    }

    public function authorized(): bool
    {
       return true;
    }
}
