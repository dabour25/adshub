<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $page="Home";
        $statistics_Data['users']=User::count();
        return view('welcome',compact('page','statistics_Data'));
    }
    public function redirectHome(){
        return redirect('/');
    }
}
