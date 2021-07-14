<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Services\RequestsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RequestsController extends Controller
{
    public function index(RequestsService $requestsService){
        $newRequests=$requestsService->getNewRequests();
        return view('admin.requests.index',compact('newRequests'));
    }
    public function show($request_id,RequestsService $requestsService){
        $request_data=$requestsService->getRequest($request_id);
        $requestsService->convertToSeen($request_id);
        return view('admin.requests.show',compact('request_data'));
    }
    public function oldRequests(RequestsService $requestsService){
        $oldRequests=$requestsService->getOldRequests();
        return view('admin.requests.old',compact('oldRequests'));
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
