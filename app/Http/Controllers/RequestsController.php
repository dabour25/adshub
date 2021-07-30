<?php

namespace App\Http\Controllers;


use App\Requests\Requests\CreateRequestValidator;
use App\Services\RequestsService;
use App\Services\TransactionsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RequestsController extends Controller
{
    public function index(){
        $page["title"]='New Request';
        $page["section"]='user';
        return view('requests.index',compact('page'));
    }
    public function store(CreateRequestValidator $createRequestValidator,RequestsService $requestsService){
        $data=$createRequestValidator->request()->except('_token');
        $response=$requestsService->createRequest($data);
        Session::put('status', $response['status']);
        Session::put('message', $response['message']);
        return back();
    }

}
