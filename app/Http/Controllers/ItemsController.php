<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = ['item1', 'item2', 'item3'];
        return view('items/index', ['items' => $items]);
    }

    public function create()
    {
        return view('items/create');
    }
}
