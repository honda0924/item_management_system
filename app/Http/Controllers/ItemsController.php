<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

use Validator;

class ItemsController extends Controller
{
    private $itemElements = ["product_name", "arrival_source", "manufacturer", "email", "tel"];
    private $validator = [
        "product_name" => "required",
        "email" => "required|string",
        "tel" => "required|integer",
    ];

    public function index()
    {
        // $items = Item::all();
        $items = Item::paginate(5);

        return view('items/index', ['items' => $items]);
    }

    public function create()
    {
        return view('items/create');
    }
    public function store(Request $request)
    {
        $input = $request->only($this->itemElements);

        $validator = Validator::make($input, $this->validator);
        if ($validator->fails()) {
            return redirect()->action("ItemsController@create")
            ->withInput()
            ->withErrors($validator)
        }

        $request->session()->put("form_input", $input);

        return redirect()->action("ItemsController@confirm");
    }
    public function confirm
    {
        $input = $request->session()->get("form_input");

        if(!$input){
            return redirect()->action("ItemsController@create");
        }
        return view("items/confirm", ["input"=>$input]);
    }
}
