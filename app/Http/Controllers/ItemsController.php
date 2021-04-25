<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items/index', ['items' => $items]);
    }

    public function create()
    {
        return view('items/create');
    }
}
