<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    public function index(){
        $page['title']="Home";
        $page['section']="Home";
        $statistics_Data['users']=User::count();
        $statistics_Data['totalAds']=Ads::where('approved',2)->count();
        $statistics_Data['total_views']=Ads::sum('views');
        $statistics_Data['total_earnings']=Ads::sum('spent_cost')*40/100;
        return view('welcome',compact('page','statistics_Data'));
    }
    public function terms(){
        $page["title"]="Terms & Conditions";
        $page["section"]="terms";
        if(App::isLocale("en"))
            return view('terms',compact('page'));
        return view('terms_ar',compact('page'));
    }
    public function redirectHome(){
        return redirect('/');
    }

    public function lang($language){
        Session::put(['lang'=>$language]);
        return back();
    }
}
