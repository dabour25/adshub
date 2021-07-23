<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use App\Requests\ChangePasswordValidator;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function Symfony\Component\String\b;

class CustomAuthController extends Controller
{

    public function getUser($slug){
        return User::where('slug',$slug)->first();
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
            }elseif(Auth::user()->user_status=='blocked'){
                return redirect('/logout');
            }
            return redirect('/');
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


    public function customRegistration(Request $request,UsersService $usersService)
    {
        $request->validate([
            'name' => 'required|min:6|max:50',
            'email' => 'required|email|unique:users,email|min:5|max:50',
            'phone' => 'required|min:11|max:13|unique:users,phone',
            'paypal_email'=>'nullable|min:5|max:50|email|unique:users,paypal_email',
            'password' => 'required|min:6|confirmed',
            'refid'=>'nullable|unique:users,affiliate_id',
        ]);

        $data = $request->all();
        $checkPaypal=$usersService->phone_paypal_check($data['phone'],$data['paypal_email']);
        $data['affiliate_id']=$data['refid']??null;
        $data['affiliate_id']=$this->getUser($data['affiliate_id'])->id??null;
        $data['slug']=Str::slug(substr($data['name'],0,3).'-'.Str::random(6).rand(100,999));
        unset($data['refid']);
        if($checkPaypal=='Success'){
            $check = $this->create($data);
            UserData::create(['user_id'=>$check->id]);
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
            'password' => Hash::make($data['password']),
            'slug' => $data['slug'],
            'affiliate_id' => $data['affiliate_id'],
        ]);
    }


    public function profile()
    {
        $page='Profile';
        return view('profile.show',compact('page'));
    }

    public function profileEdit(){
        $page='Edit Profile';
        $user_data=UserData::where('user_id',Auth::user()->id)->first();
        if(!$user_data){
            $user_data['country']=$user_data['city']=$user_data['age']=$user_data['nationality']
            =$user_data['gender']=$user_data['address']=null;
        }
        return view('profile.edit',compact('page','user_data'));
    }

    public function profileUpdate(Request $request){
        $data=$request->except('_token');
        $user_data=UserData::where('user_id',Auth::user()->id)->first();
        if(!$user_data){
            $data['user_id']=Auth::user()->id;
            UserData::create($data);
        }else{
            UserData::where('id',$user_data->id)->update($data);
        }
        return back();
    }

    public function changePassword(ChangePasswordValidator $changePasswordValidator){
        $data=$changePasswordValidator->request()->except('_token');
        if(!Hash::check($data['old_password'],Auth::user()->getAuthPassword())){
            Session::put('status', 'danger');
            Session::put('message', 'Old Password Not Match Our Records');
            return back();
        }
        User::where('id',Auth::user()->id)->update(['password'=>Hash::make($data['password'])]);
        Session::put('status', 'success');
        Session::put('message', 'Password Changed Successfully');
        return back();
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
