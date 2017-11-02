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
}