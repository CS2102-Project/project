<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use mysqli;
use Illuminate\Support\Facades\Auth;

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

    /**
     *
     * Add the self-defined function with signature to prevent from overriding
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login_shaocong()
    {
        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $data = $_POST;
        $email = $data['email'];
        $password_entered = $data['password'];
        $sql = "select u.password, u.username from users u where u.email = '".$email."'";
        $password_array = $db->query($sql);
        $password_record = $password_array->fetch_assoc();
        $password = $password_record["password"];
        $username = $password_record["username"];
        if ((!$password)||($password_entered!=$password)) {
            return view('home');
        }
        else {
            $this->middleware('authenticated');
            return view('users.profile', compact ('email', 'username'));
        }
    }

    /**
     *
     * Add signature to this self defined functions to prevent from overriding
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function authenticate_shaocong()
    {
        $data = $_POST;
        $email = $data['email'];
        $password = $data['password'];
        print($email);
        print($password);
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            //return redirect()->route('profile');
            return view('users.profile', compact ('email', 'username'));
        }
        else
        {
            print('error');
        }
    }
}
