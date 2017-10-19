<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysqli;

class PostController extends Controller
{
    public function postSubmit($itemId)
    {
        $user = Auth::user();
        $userid = $user['id'];

        $input = $_POST;
        $title = $input['Title'];
        $location = $input['Location'];
        $description = $input['Description'];
        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "INSERT INTO posts (item, title, location, description) VALUES ('" .$itemId."','".$title."','".$location."','".$description."');";
        //print($sql);
        //return 1;
        $db->query($sql);
        return redirect('users/'.$userid);

    }
}
