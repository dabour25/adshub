<?php

namespace App\Requests\Contact;


use App\Requests\BaseRequestForm;


class ContactValidator extends BaseRequestForm
{

    public function rules(): array
    {
        return [
            'name'=> 'required|min:3|max:50',
            'email'=> 'required|email|min:5|max:50',
            'subject'=> 'required|min:3|max:50',
            'message'=> 'required|min:5',
        ];
    }

}
