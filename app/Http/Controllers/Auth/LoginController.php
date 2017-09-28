<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use mysqli;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $data = $_POST;
        $email = $data['email'];
        $password_entered = $data['password'];
        $sql = "select u.password from users u where u.email = '".$email."'";
        $password_array = $db->query($sql);
        $password_record = $password_array->fetch_assoc();
        $password_record = $password_record["password"];
        if ((!$password_record)||($password_entered!=$password_record)) {
            return view('home');
        }
        else {
            $this->middleware('authenticated');
            return view('users.profile', compact ('email'));
        }
    }
}
