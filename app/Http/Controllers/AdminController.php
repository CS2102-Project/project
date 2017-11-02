<?php

namespace App\Http\Controllers;

use mysqli;

class AdminController
{
    function direct()
    {
        return view('admin.all');
    }

    function deleteUser($userId) {
        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        $sql = "Delete from users where users.id =".$userId.";";
        $db->query($sql);
        return view('admin.all');
    }

    function newUser () {
        return view('admin.newUser');
    }

    function editUser ($userId) {

        return view('admin.editUser', compact('userId'));
    }

    function editUserSubmit ($userId) {
        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        $input = $_POST;
        $username = $input['username'];
        $email = $input['email'];
        $mobile = $input['mobile'];
        $address = $input['address'];
        $password = $input['password'];


        $sql = "Update users u set u.username = '".$username."', u.email = '".$email.
            "', u.mobile = ".$mobile.", u.password = '".$password."', u.address = '".$address."' where u.id =".$userId.";";



        //return $sql;
        $db->query(($sql));

        return redirect('admin');
    }
}