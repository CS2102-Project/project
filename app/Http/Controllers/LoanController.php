<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysqli;


class LoanController extends Controller
{
    function returnLoan ($loanId)
    {

        $user = Auth::user();
        $userid = $user['id'];

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        //Get the bid id of this loan
        $sql = "SELECT l.bid from loans l where l.loanid = ".$loanId.";";
        $result = $db->query($sql);

        $row = $result->fetch_assoc();
        $bidid = $row['bid'];

        //Delete this successful bid
        $sql = "DELETE from bids b where b.bidid = ".$bidid.";";
        $db->query($sql);

        //Toggle the status of this loan as 'RETURNED'
        $sql = "UPDATE loans l set l.status = 'RETURNED' where l.loanid = ".$loanId.";";
        $db -> query($sql);

        return redirect('users/'.$userid);

    }

}
