<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\AdsService;
use App\Services\RequestsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdsController extends Controller
{
    public function index(AdsService $adsService){
        $newAds=$adsService->getNewAds();
        return view('admin.ads.index',compact('newAds'));
    }
    public function oldAds(AdsService $adsService){
        $oldAds=$adsService->getOldAds();
        return view('admin.ads.old',compact('oldAds'));
    }
    public function show($ad_id,AdsService $adsService){
        $ad_data=$adsService->getAd($ad_id);
        return view('admin.ads.show',compact('ad_data'));
    }

    public function store(Request $request,RequestsService $requestsService){
        $data=$request->except('_token');
        $response=$requestsService->approveRequest($data);
        if(!$response){
            session()->push('m','danger');
            session()->push('m','You Must fill amount and less than request amount');
            return back();
        }
        session()->push('m','success');
        session()->push('m','Request Approved');
        return back();
    }
    public function cancelRequest($request_id,RequestsService $requestsService){
        $data['request_id']=$request_id;
        $requestsService->cancelRequest($data);
        return back();
    }
}
