<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){
        $usercount=User::count();
        $messages_count=Contact::where('seen',0)->count();
        $requests_count=\App\Models\Request::where('seen',0)->count();
        return view('admin.index',compact('usercount','messages_count','requests_count'));
    }
}
