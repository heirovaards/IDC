<?php

namespace App\Http\Controllers;
use App\Ocupation;
use App\User;
use App\Interest;
use Illuminate\Support\Facades\Auth;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Registration;
use App\Event;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\User_role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class AuthController extends Controller
{

  public function getLogin()
  {
    return View('pages.login');
  }

//  login retrieval
  public function postLogin(Request $request)
  {

//    login validator
      $this -> validate($request,[
          'password'=> 'required',
          'login'=> 'required',
      ]);


//    login username retrieval
      if (Auth::attempt([
          'email' => $request->login,
          'password' => $request->password,
          'confirmed' => 'confirmed']))
      {

//          user role verification
          $user = User::find(Auth::user()->id);
          if ($user->hasRole('user'))
          {
              return redirect()->route('user');
          }

          elseif ($user->hasRole('admin'))
          {
              return redirect()->route('admin');
          }

          elseif ($user->hasRole('organization'))
          {
              return redirect()->route('organization');
          }

      }


//      login username retrieval
      elseif (Auth::attempt([
          'username' => $request->login,
          'password' => $request->password,
          'confirmed' => 'confirmed']))
      {
//         user role verification
          $user = User::find(Auth::user()->id);
          if ($user->hasRole('user'))
          {

              return redirect()->route('user');
          }

          elseif ($user->hasRole('admin'))
          {
              return redirect()->route('admin');
          }

          elseif ($user->hasRole('organization'))
          {
              return redirect()->route('organization');
          }
      }

      else
      {
          return redirect()->route('login')->with('loginError', 'user not found');
      }
  }

//  Get registration command
  public function getRegister()
  {

//    get all value from interest table
      $interest = Interest::all();
      $ocupation = Ocupation::all();

//    parse interest value into the view
      return View('pages.signup', compact('interest', 'ocupation'));
  }

  public function postRegister(Request $request)
  {
//  Registration validator
    $this -> validate($request,[
        'password'=> 'required|min:6|confirmed',
        'username'=> 'required|unique:users|min:8',
        'name' => 'required|min:6',
        'ocupation' => 'required',
        'phonenumber' => 'required|numeric',
        'email' => 'unique:users',
        'avatar' => 'required',
        'poster' => 'mimes:jpeg,bmp,png'
    ]);


    $avatar = $request->file('avatar')->store('avatars');
    $confirmation_code=str_random(40);
//  User Registration
    $user = User::create([
                'name' => $request->name,
                'username'=> $request->username,
                'email' => $request->email ,
                'password'=> bcrypt($request->password),
                'role' => 'volunteer',
                'interest' => $request->interest_id,
                'ocupation' => $request->ocupation,
                'phone' => $request -> phonenumber,
                'avatar'=> $avatar,
                'token' => $confirmation_code,
                'confimed' => 'registed'
    ]);

    $data = $request->toArray();
    $data['token']=$confirmation_code;

//    dd($data);
        $user_role = $request->role;
        $role = Role::where('name', '=', $user_role)->first();
        $user->attachRole($role);

      Mail::send('email.verify', $data, function($message) use($data, $confirmation_code)
          {
              $message->to($data['email'])
                  ->subject('Verify your email address');
          });

        return redirect()->route('login')->with('user_recorded','User Successfully Recorded ');

  }

//  logout function
  public function logout()
  {
      Auth::logout();

      return redirect()->route('login');
  }

//  profile page funtion
  public function profile()
  {
      $role = User::find(Auth::user()->id);



//      if user role is user / volunteer it will recieved the registered event and attended evet
      if ($role->hasRole('user'))
      {
          $id = Auth::user()->id;
          $user = User::where('id', $id)->get();
//          get the user id
          $id = Auth::id();
//          get the registered event
          $event = Registration::with('events')->where('userid','=', $id)->get();
//          get attended event
          $attended = Registration::with('events')
              ->where([
                  ['status','=', 'attended'],
                  ['userid', '=', $id],
              ])
              ->orWhere([
                  ['userid', '=', $id],
                  ['status','=', 'commented']
              ])
              ->get();
          return view('pages.profile', compact('event', 'attended','user'));
      }

      elseif ($role->hasRole('organization'))
      {
          $id = Auth::user()->id;
          $user = User::where('id', $id)->get();
          $id = Auth::id();
          $event = Event::where('userid','=',$id)->get();
          return view('pages.profile', compact('event','user'));
      }

      elseif ($role->hasRole('admin'))
      {
          $id = Auth::user()->id;
          $user = User::where('id', $id)->get();
          $pending = Event::where('eventstatus', '=', 'pending')->limit(15)->latest()->get();
          $newuser = User::with('roles')->latest()->limit(15)->get();
          $usercount = User::count();
          $uservolunteer = User_role::where('role_id','=', 2)->count();
          $userorganization = User_role::where('role_id','=', 4)->count();
          $eventapproved= Event::where('eventstatus','=','approved')->count();
          $eventpending= Event::where('eventstatus','=','pending')->count();
          $totalevent= Event::count();
          return view('pages.profile', compact('pending', 'newuser', 'usercount', 'totalevent', 'uservolunteer' , 'userorganization','eventapproved','eventpending','user'));
      }

  }

  public function confirm($token)
  {
      if( ! $token)
      {
          return redirect()->route('login')->with('token_error', 'user_token_error');
      }

      $user = User::where('token',$token)->first();

      if ( ! $user)
      {
          return redirect()->route('login')->with('token_error', 'user_token_error');
      }

      $user->confirmed = 'confirmed';
      $user->token = null;
      $user->save();


      return redirect()->route('login')->with('confirmed', 'thank you for your confimation');
  }

  public function forgotPasswordForm()
  {
    return view('pages.forgot_password');
  }

  public function requestEditPassword(Request $request)
  {
      $this -> validate($request,[
          'login'=> 'required|exists:users,email',
      ]);

      $confirmation_code=str_random(40);
      $users = User::where('email', $request->login)->first();
      $data = $users->toArray();
      $data['token']= $confirmation_code;

//      dd($data);

      $users->update([
          'token'=>$confirmation_code,
      ]);

      Mail::send('email.reset_password', $data, function($message) use($data)
      {
          $message->to($data['email'])
              ->subject('Reset Password Request');
      });

      \Session::flash('check_email', 'check your email address' );
      return redirect()->route('login')->with('check_email','check your email address');

  }

  public function editPasswordLink($token)
  {
      if( ! $token)
      {
          return redirect()->route('login')->with('token_error', 'user_token_error');
      }

      $user = User::where('token',$token)->first();

      if ( ! $user)
      {
          return redirect()->route('login')->with('token_error', 'user_token_error');
      }


      return view('pages.reset_password', compact('token'));
  }

    public function resetPassword(Request $request)
    {
        $this->validate($request,[
            'password'=> 'required|min:6|confirmed',
        ]);
        $token = $request->token;
        if( ! $token)
        {
            return redirect()->route('login')->with('token_error', 'user_token_error');
        }

        $user = User::where('token',$token)->first();

        if ( ! $user)
        {
            return redirect()->route('login')->with('token_error', 'user_token_error');
        }

        $user->update([
           'password'=>bcrypt($request->password),
            'token'=>null,
        ]);

        \Session::flash('update_password', 'use new password' );
        return redirect()->route('login')->with('update_password','use new password');
    }


}
