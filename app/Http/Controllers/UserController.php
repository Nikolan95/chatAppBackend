<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(storeUserRequest $request)
    {
        //return $request;
       

         $user = User::create([
			'name'=>$request['name'],
            'company'=>$request['company'],
            'street'=>$request['street'],
            'city'=>$request['city'],
            'phoneNumber'=>$request['phoneNumber'],
			'email'=>$request['email'],
			'password'=>Hash::make($request['password']),
            
		 ]);
		return new UserResource($user);
         
    }
    public function current()  {
		return new UserResource(auth()->user());
	}

    public function fcmToken(Request $request)
    {
        $user = User::find(auth()->id());
        auth()->user()->update(['fcm_token'=> $request['fcm_token']]);

        return response()->json('fcm updated successfully', 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'company'=>'required',
            'street'=>'required',
            'city'=>'required',
            'phoneNumber'=>'required',

        ]);
        $user = User::find(auth()->id());
        $user->name = $request['name'];
        $user->company = $request['company'];
        $user->street = $request['street'];
        $user->city = $request['city'];
        $user->phoneNumber = $request['phoneNumber'];
        $user->save();
        return new UserResource($user);
    }
    public function loginPage()
    {
        return view('login');
    }
    public function registerPage()
    {
        return view('register');
    }
    public function registerFromApp(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'company' => 'required',
            'street' => 'required',
            'city' => 'required',
            'telefon' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6',
         ]);

         $user = User::create([
			'name'=>$request['name'],
            'surname'=>$request['surname'],
            'company'=>$request['company'],
            'street'=>$request['street'],
            'city'=>$request['city'],
            'telefon'=>$request['telefon'],
			'email'=>$request['email'],
			'password'=>Hash::make($request['password']),
            
		 ]);


        if($user->save()){
            Auth::loginUsingId($user->id);
            return redirect('/dashboard');
        }
    }
    public function loginFromApp(Request $request)
    {
        $email=$request->input('email');
        $password=$request->input('password');

        $request->session()->put('user', $request->input('email'));
        
        if($user = User::where('email', '=', $email)->first()){
            if(Hash::check($password, $user->password)){           
                Auth::loginUsingId($user->id);
                return redirect('/dashboard')->with('success', 'login success');     
            }
            else{       
                return back()->with('errorpass', 'Password doesn\'t match with this email');
            }
        }
        else{
            return back()->with('erroremail', 'No email found');
        }    
    }
    public function logoutFromApp()
    {
        Auth::logout();
        return view('login');
    }
}
