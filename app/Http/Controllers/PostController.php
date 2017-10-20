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

    public function marketOverview()
    {
        $user = Auth::user();
        return view('posts.market', compact('user'));
    }

    public function bidPost($postId)
    {
        return view('bids.new', compact('postId'));
    }

    public function bidPointSubmit($postId)
    {
        $user = Auth::user();
        $userid = $user['id'];
        $email = $user['email'];

        $input = $_POST;
        //print_r($input);
        //return 1;
        $point = $input['Point'];

        //Database connection::
        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0)
        {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        //Firstly we check the remaining of points is not too low
        $sql = "SELECT * from users u where u.email = '".$email."';";
        $result = $db->query($sql);
        $row = $result -> fetch_assoc();
        $available_points = $row['points_available'];

        //Notify the user that he or she does not own enough points for this bidding (double check)
        if ($available_points < $point)
        {
            echo ("<script> 
                        alert('You do not have enough points available!'); 
                        window.location.href = '../../posts/".$postId."/bid';
                   </script>");
        }

        //Secondly we will proceed to the update of the current user's bidding
        //We don't update its bidding point (incomplete transaction)
        $sql = "INSERT INTO bids (bidder, post, points) VALUES ('".$email."', ".$postId.", ".$point.")";
        $db->query($sql);
        return redirect('users/'.$userid);

    }

}
