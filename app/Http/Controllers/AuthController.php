<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(){
        return view('auth.register');

  }
     
     
  public function registerStore(Request $request){
            
    $request->validate([
        'email'=>'email|required',
        'first_name'=>'required',
        'password'=>'required',
        'confirm_password'=>'same:password',
        'exam_type'=>'required',


    ]);
        
$url = "https://hangukapi.nitlegend.com/login/registerUser";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data =[
  "first_name"=> $request->first_name,
  "last_name"=>$request->last_name,
  "email"=> $request->email,
  "mobile"=> $request->mobile,
  "password"=> $request->password,
  "exam_type"=>$request->exam_type ,
  "course_type"=> "exam"

];

$data=json_encode($data);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$res=json_decode($resp);
if($res->status){
    $message=[
        'alert-type'=>'success',
         'content'=>'successfully register'
    ];
    return redirect()->route('user.logins')->with('message',$message);

}else{
    $message=[
        'alert-type'=>'danger',
         'content'=>$res->message
    ];
return redirect()->back()->with('message',$message);
}

   }


 public function login(){
      return view('auth.login');
 }

public function loginStore(Request $request){

    $data =[
        "email"=> $request->email,
        "password"=> $request->password,      
      ];


 $url = "https://hangukapi.nitlegend.com/login/loginUser";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data =
[
  "email"=> $request->email,
  "password"=> $request->password,
];

curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

$res=json_decode($resp);

if($res->status){
    session()->put('user',$res->data);
    $message=[
        'alert-type'=>'success',
         'content'=>'successfully Login'
    ];
    return redirect()->route('dashboard')->with('message',$message);

}else{
    $message=[
        'alert-type'=>'danger',
         'content'=>$res->message
    ];
return redirect()->back()->with('message',$message);
}


         }




         public function dashboard(){
            return view('dashboard');
         }

         public function logout(){
            session()->forget('user');
            return redirect('/');
         }

}
