<?php

namespace App\Http\Controllers;

use Request;
use DB;
use mysqli;
use App\User;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return array
   */
  public function store()
  {

      $input = Request::all();
      $username = $input['username'];
      $email = $input['email'];
      $mobile = $input['mobile'];
      $address = $input['address'];
      $password = $input['password'];
      //{"_token":"rTdqcdRyXOyhuysbr8upWorrRw0MYNZRYGQPB8pM","username":"123","email":"123@1.com","mobile":"1231","address":"123","password":"123123","password_confirmation":"123123"}

      $id = 1;
      //$id = DB:statement('select u.userid from users as u where u.username = $username');

      //DB::statement('insert into users (username, email, mobile, address, password)
      //            values ($username, $email, $mobile, $address, $password)');
      //
      return redirect('users/'.$id);

  }

  /**
   * Display the specified resource.
   * Fetch all the items owned for this user (DB)
   * Fetch all the items bid for this user (DB)
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
      $db = new mysqli('localhost', 'root', 'admin', 'blog');
      if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
      }

      $sql = "select u.username from users as u where u.id = ".$id;
      $result_array = $db->query($sql)->fetch_assoc();
      $username = $result_array["username"];
      $sql = "select u.email from users as u where u.id = ".$id;
      $result_array = $db->query($sql)->fetch_assoc();
      $email = $result_array["email"];
      return view('users.profile', compact('id', 'username', 'email'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      //
  }

  public function login()
  {
      $input = Request::all();
      $email = $input['email'];
      $password = $input['password'];
      $db = new mysqli('localhost', 'root', 'admin', 'blog');
      if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
      }

      $sql = "select u.id, u.password from users as u where u.email = '".$email."';";
      $result_array = $db->query($sql);
      $result = $result_array->fetch_assoc();
      $userid = $result["id"];
      $correct_password = $result['password'];
      $user = User::find($userid);

      if ((!$user) || ($password!=$correct_password))
      {
          //return [bcrypt($password), $correct_password]; //view('home');
          return view('home');
      }
      Auth::login($user, true);
      return redirect('users/'.$userid);

  }

  public function transactionsDisplay( $userId )
  {
      return view('users.transactions',compact('userId'));
  }

  public function showStatistics ($userId)
  {
      return view('users.statistics', compact('userId'));
  }


}

