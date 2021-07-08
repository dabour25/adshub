<?php

namespace App\Http\Controllers;

use App\Requests\Contact\ContactValidator;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        $page='Contact Us';
        return view('contact',compact('page'));
    }

    public function store(ContactValidator $contactValidator,ContactService $contactService){
        $contactService->createMessage($contactValidator->request()->except('_token'));
        Session::put('status', 'success');
        Session::put('message', 'Message Sent to admin successfully');
        return back();
    }
}
