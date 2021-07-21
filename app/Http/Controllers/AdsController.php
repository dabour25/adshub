<?php

namespace App\Http\Controllers;

use App\Requests\Ads\CreateAdValidator;
use App\Services\AdsService;
use App\Services\ContactService;
use Illuminate\Support\Facades\Session;

class AdsController extends Controller
{
    public function index(){
        $page='Create Ad';
        return view('create_ad',compact('page'));
    }

    public function store(CreateAdValidator $adValidator,AdsService $adsService){
        $response=$adsService->createAd($adValidator);
        if($response!="success"){
            Session::put('status', 'danger');
            Session::put('message', $response);
            return back()->withInput($adValidator->request()->input());
        }
        Session::put('status', 'success');
        Session::put('message', 'Ad Created, Waiting Admin Approval');
        return back();
    }
}
