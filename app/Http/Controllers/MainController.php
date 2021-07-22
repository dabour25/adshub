<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $page="Home";
        $statistics_Data['users']=User::count();
        $statistics_Data['totalAds']=Ads::where('approved',2)->count();
        return view('welcome',compact('page','statistics_Data'));
    }
    public function terms(){
        $page="Terms & Conditions";
        return view('terms',compact('page'));
    }
    public function redirectHome(){
        return redirect('/');
    }
}
