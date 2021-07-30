<?php

namespace App\Http\Controllers;

use App\Requests\Ads\CreateAdValidator;
use App\Services\AdsService;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        Session::put('message', __("strings.Ad Created, Waiting Admin Approval"));
        return back();
    }

    public function showAds(AdsService $adsService){
        $ads=$adsService->getAdsForShow();
        $page["title"]="View Ads";
        $page["section"]="view ads";
        return view('view_ads',compact('page','ads'));
    }

    public function earnAd(Request $request,AdsService $adsService){
        $data=$request->except('_token');
        $response=$adsService->earnAd($data);
        return response()->json($response['data'],$response['status']);
    }

    public function userAds(AdsService $adsService){
        $ads=$adsService->userAds(Auth::user()->slug);
        $page["title"]="User Ads";
        $page["section"]="user";
        return view('user_ads',compact('page','ads'));
    }
    public function userAd($slug,AdsService $adsService){
        $ad=$adsService->getAd($slug);
        $page["title"]="AD ".$ad->title;
        $page["section"]="user";
        return view('user_ad_view',compact('page','ad'));
    }
}
