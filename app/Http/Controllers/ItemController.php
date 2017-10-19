<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use mysqli;
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

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "select * from items i where i.itemid = ". $itemId.";";
        $items_owned = $db->query($sql);

        $row = $items_owned->fetch_assoc();
        $itemName = $row['name'];
        $itemDescription = $row['description'];

        $this->delete($itemId);

        return view('items.edit', compact('itemId', 'itemName','itemDescription'));
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

    public function delete ($itemId)
    {
        $user = Auth::user();
        $userid = $user['id'];

        $db = new mysqli('localhost', 'root', 'admin', 'blog');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "DELETE from items where items.itemid = ".$itemId.";";
        $db->query($sql);
        return redirect('users/'.$userid);

    }

    public function post ($itemId)
    {
        return view('posts.new', compact('itemId'));
    }

}
