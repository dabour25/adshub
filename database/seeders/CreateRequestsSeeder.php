<?php

namespace Database\Seeders;

use App\Models\Request;
use App\Models\User;
use App\Models\UserData;
use App\Services\RequestsService;
use App\Services\TransactionsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount=User::count();
        $selectedUser=rand(1,$usersCount);
        $selectedUser=User::where('id',$selectedUser)->first();
        $requestsService=new RequestsService();
        //Create Random Request
        if($selectedUser){
            $request=null;
            $randDeposit=rand(0,9);
            if($randDeposit<7){
                $amount=rand(20,4999)+rand(0,99)/100;
                $requestData['request_id']='DR-'.rand(10,99).$selectedUser->id.Str::random(4);
                $requestData['amount']=$amount;
                $requestData['reason']='deposit';
                $requestData['method']=$selectedUser->paypal_email!=null?'paypal':'vf-cash';
                $requestData['user_id']=$selectedUser->id;
                $request=Request::create($requestData);
                User::where('id',$selectedUser->id)->update(['pending_balance'=>$amount]);
            }elseif($randDeposit>=7&&$selectedUser->balance>52){
                $amount=rand(51,intval($selectedUser->balance))-rand(0,99)/100;
                $requestData['request_id']='WR-'.$selectedUser->id.STR::random(4);
                $requestData['amount']=$amount;
                $requestData['reason']='withdraw';
                $requestData['method']=$selectedUser->paypal_email!=null?'paypal':'vf-cash';
                $requestData['user_id']=$selectedUser->id;
                $request=Request::create($requestData);
                User::where('id',$selectedUser->id)->update(['pending_balance'=>$amount]);
                $transactionService=new TransactionsService();
                $transaction['comment']="Pending for withdraw";
                $transaction['user_id']=$selectedUser->id;
                $transaction['amount']=$amount;
                $transaction['transaction_type']="withdraw";
                $transactionService->createTransaction($transaction);
            }
            //Create Random admin Response
            if($request!=null){
                $randApprove=rand(0,9);
                if($randApprove<5){
                    if($request['reason']=='deposit'){
                        $transactionService=new TransactionsService();
                        $transaction['comment']="Successful Deposit";
                        $transaction['user_id']=$request['user_id'];
                        $transaction['amount']=$request['amount']-5;
                        $transaction['transaction_type']="deposit";
                        $transactionService->createTransaction($transaction);
                        User::where('id',$selectedUser->id)->update(['pending_balance'=>0]);
                    }else{
                        $transactionService=new TransactionsService();
                        $transaction['comment']="Successful Withdraw";
                        $transaction['user_id']=$request['user_id'];
                        $transaction['amount']=$request['amount'];
                        $transaction['transaction_type']="withdraw";
                        $transactionService->createTransaction($transaction);
                        User::where('id',$selectedUser->id)->update(['pending_balance'=>0]);
                    }
                    $request->request_status=1;
                    $request->seen=1;
                    $request->save();
                }elseif ($randApprove<8){
                    $request->request_status=2;
                    $request->seen=1;
                    $request->save();
                    if($request['reason']=='deposit'){
                        User::where('id',$selectedUser->id)->update(['pending_balance'=>0]);
                    }else{
                        $transactionService=new TransactionsService();
                        $transaction['comment']="Failed Withdraw";
                        $transaction['user_id']=$request['user_id'];
                        $transaction['amount']=$request['amount'];
                        $transaction['transaction_type']="deposit";
                        $transactionService->createTransaction($transaction);
                        User::where('id',$selectedUser->id)->update(['pending_balance'=>0]);
                    }
                }
            }
        }

    }
}
