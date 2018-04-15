<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRegisterRequest $request)
    {
        $data=[
            'confirm_code'=>str_random(48),
            'avatar'=>'/images/default_avatar.jpg',
        ];
        User::register(array_merge($request->all(),$data),$data);
        return redirect('/user/login');
    }

    public function confirmedEmail($confirm_code)
    {
       $user=User::where('confirm_code',$confirm_code)->first();
       if (is_null($user)){
           return redirect('/');
       }
       $user->confirm_code=str_random(48);
       $user->is_confirmed=1;
       $user->save();
       return redirect('/user/login');
    }

    public function login()
    {
        $users=User::all();
        return view('user.login',compact('users'));
    }

    public function showAvatar()
    {
        $email=Input::get('email');
        $users=User::all();
        foreach ($users as $user){
            if ($user->email==$email){
                $data=$user->avatar;
                return $data;
            }
        }
    }

    public function avatar()
    {
        return view('forum.avatar');
    }

    public function changeAvatar(Request $request)
    {
        $file=$request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }
        $filePath='upload/';
        $fileName=Auth::user()->id.'_'.time().$file->getClientOriginalName();
        $file->move($filePath,$fileName);
        Image::make($filePath.$fileName)->fit(400)->save();
        return Response::json([
            'success'=>'success',
            'avatar'=>'/'.$filePath.$fileName
        ]);
    }

    public function cropAvatar(Request $request)
    {
        $photo=mb_substr($request->get('photo'),1);
        $width=$request->get('w');
        $height=$request->get('h');
        $xAlign=$request->get('x');
        $yAligb=$request->get('y');
        Image::make($photo)->crop($width,$height,$xAlign,$yAligb)->save();
        $user=Auth::user();
        $user->avatar=$request->get('photo');
        $user->save();
        return redirect('/user/avatar');
    }

    public function signup(Requests\UserSignUpRequest $request)
    {
       if (Auth::attempt([
           'email'=>$request->get('email'),
           'password'=>$request->get('password'),
           'is_confirmed'=>1
       ])){
            return redirect('/');
       }else{
           Session::flash('user_login_failed','用户名或密码错误或邮箱没通过验证！');
           return redirect('/user/login')->withInput();
       }
    }

    public function password()
    {
        return 2333;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
