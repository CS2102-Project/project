<?php

namespace App\Http\Controllers;

use Request;
use DB;


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
      $username = 'Shaocong';
      //$username = DB:statement('select u.username from users as u where u.userid = $id');
      return view('users.profile', compact('id', 'username'));
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
}
