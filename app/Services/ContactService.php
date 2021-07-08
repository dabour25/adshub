<?php

namespace App\Services;

use App\Models\Contact;

class ContactService{
    public function createMessage($data){
        $contact=Contact::create($data);
        return $contact;
    }
}
