<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;

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
}
