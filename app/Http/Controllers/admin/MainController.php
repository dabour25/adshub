<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){
        $usercount=User::count();
        $messages_count=Contact::where('seen',0)->count();
        $requests_count=\App\Models\Request::where('seen',0)->count();
        $ads_count=Ads::where('seen',0)->count();
        return view('admin.index',compact('usercount','messages_count','requests_count','ads_count'));
    }
    public function messages(){
        $messages=Contact::orderBy('id','desc')->paginate(50);
        Contact::where('seen',0)->update(['seen'=>1]);
        return view('admin.messages',compact('messages'));
    }
}
