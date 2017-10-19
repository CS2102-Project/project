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

    public function delete($postId)
    {
        $user = Auth::user();
        $userid = $user['id'];

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "DELETE from posts where posts.postid = ".$postId.";";
        $db->query($sql);
        return redirect('users/'.$userid);
    }

    public function editShow($postId)
    {
        return view('posts.edit',compact('postId'));
    }

    public function editSubmit($postId)
    {
        $user = Auth::user();
        $userid = $user['id'];

        $input = $_POST;
        //print_r($input);
        $title = $input['Title'];
        $location = $input['Location'];
        $description = $input['Description'];

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "UPDATE posts set posts.title = '".$title."', posts.location = '".$location."', posts.description = '".$description."' where posts.postid = ".$postId.";";
        //print($sql);
        //return 1;
        $db->query($sql);

        return redirect('users/'.$userid);
    }


}
