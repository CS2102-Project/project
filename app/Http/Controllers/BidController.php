<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysqli;

class BidController extends Controller
{
    public function delete ($bidId)
    {
        $user = Auth::user();
        $userid = $user['id'];

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "DELETE from bids where bids.bidid = ".$bidId.";";

        //print($sql);
        //return 1;
        $db->query($sql);

        return redirect('users/'.$userid);
    }

    public function reject ($bidId)
    {
        $user = Auth::user();
        $userid = $user['id'];

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "DELETE from bids where bids.bidid = ".$bidId.";";

        //print($sql);
        //return 1;
        $db->query($sql);

        return redirect('users/'.$userid.'/transactions');
    }

    public function editShow ($bidId)
    {
        return view('bids.edit', compact('bidId'));
    }

    public function editSubmit ($bidId)
    {

        $user = Auth::user();
        $userid = $user['id'];
        $email = $user['email'];

        $input = $_POST;
        //print_r($input);
        //return 1;
        $points_updated = $input['Point'];

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        //Firstly we check the remaining of points is not too low
        $sql = "SELECT * from users u where u.email = '".$email."';";
        $result = $db->query($sql);
        $row = $result -> fetch_assoc();
        $available_points = $row['points_available'];
        //Notify the user that he or she does not own enough points for this bidding (double check)
        if ($available_points < $points_updated)
        {
            //return("Not enough points");
            echo ("<script> 
                        alert('You do not have enough points available!'); 
                        window.location.href = '../../bids/".$bidId."/edit';
                   </script>");
            return ('What happened');
        }

        //Next we proceed and update its bidding points
        $sql = "UPDATE bids set bids.points = ".$points_updated." where bids.bidid = ".$bidId.";";
        //print($sql);
        //return 1;

        $db->query($sql);

        return redirect('users/'.$userid);

    }

    public function accept ($bidId)
    {
        $user = Auth::user();
        $userid = $user['id'];

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "UPDATE bids set bids.status = 'SUCCESS' where bids.bidid = ".$bidId.";";

        //print($sql);
        //return 1;
        $db->query($sql);

        return redirect('users/'.$userid.'/transactions');
    }


}
