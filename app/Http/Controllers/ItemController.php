<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use phpDocumentor\Reflection\Types\Integer;

class ItemController extends Controller
{
    public function create ()
    {
        $user = Auth::user();
        return view('items.new', compact($user));
    }

    public function store ()
    {
        $user = Auth::user();
        $owner = $user['email'];

        $data = $_POST;
        Item::create([
            'name' => $data['ItemName'],
            'owner' => $owner,
            'description' => $data['Description'],
            'available' => 'true',
        ]);
        $userid = $user['id'];
        return redirect('users/'.$userid);
    }

    public function editShow ($itemId)
    {
        return view('items.edit', compact('itemId'));
    }

    public function editUpdate ()
    {
        $input = Request::all();
        $user = Auth::user();
        $userid = $user['id'];
        $itemName = $input['ItemName'];
        $itemDescription = $input['ItemDescription'];
        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "UPDATE items SET items.description = ".$itemDescription." where items.name = ".$itemName.";";
        print($sql);
        return 1;
        $db->query($sql);
        return redirect('users/'.$userid);
    }

}
