<?php

namespace App\RequestForms;

use App\RequestForms\BaseRequestForm;


class UploadValidator extends BaseRequestForm
{
    
    public function rules(): array
    {
        
        return [
            'uploaded_file' => 'required|mimes:jpeg,jpg,gif,png|file|max:2048', // 2MB
        ];
    }

    public function authorized(): bool
    {
       return true;
    }
}