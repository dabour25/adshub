<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    private function phone_paypal_check($phone,$paypal){
        if($paypal==''){
            if((substr($phone,0,3)!='010')&&(substr($phone,0,5)!='+2010')){
                return 'If there are no paypal account , you must enter vodafone cash number';
            }
        }
        return 'Success';
    }

    public function index()
    {
        $page="Login";
        return view('auth.login',compact('page'));
    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('user_id', 'password');
        if(str_contains($credentials['user_id'], '@')){
            $credentials['email']=$credentials['user_id'];
            unset($credentials['user_id']);
        }else{
            $credentials['phone']=$credentials['user_id'];
            unset($credentials['user_id']);
        }
        if (Auth::attempt($credentials)) {
            if(Auth::user()->user_status=='admin'){
                return redirect('/admin');
            }
            return redirect('/dashboard');
        }
        Session::put('status', 'danger');
        Session::put('message', 'Login details are not valid');
        return redirect("auth/login");
    }



    public function registration()
    {
        $page="Registration";
        return view('auth.register',compact('page'));
    }


    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6|max:50',
            'email' => 'required|email|unique:users,email|min:5|max:50',
            'phone' => 'required|min:11|max:13|unique:users,phone',
            'paypal_email'=>'nullable|min:5|max:50|email|unique:users,paypal_email',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();
        $checkPaypal=$this->phone_paypal_check($data['phone'],$data['paypal_email']);
        if($checkPaypal=='Success'){
            $check = $this->create($data);
            Session::put('status', 'success');
            Session::put('message', 'Registered Successfully, You can now login');
            return redirect("/auth/login");
        }else{
            Session::put('status', 'danger');
            Session::put('message', $checkPaypal);
            return back()->withInput($request->input());
        }

    }


    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'paypal_email' =>$data['paypal_email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }


    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
