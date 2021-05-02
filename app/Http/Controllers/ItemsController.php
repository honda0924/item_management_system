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
        "arrival_source" => "nullable",
        "manufacturer" => "nullable",
        "email" => "required|string",
        "tel" => "required|integer",
    ];

    public function index()
    {
        $items = Item::paginate(5);

        return view('items/index', ['items' => $items]);
    }

    public function create()
    {
        return view('items/create');
    }
    public function post(Request $request)
    {
        $input = $request->only($this->itemElements);

        $validator = validator($this->validator);
        if ($validator->fails()) {
            return redirect('item/create')
                ->withInput()
                ->withErrors($validator);
        }

        $request->session()->put("form_input", $input);

        return redirect('item/confirm');
    }
    public function confirm(Request $request)
    {
        $input = $request->session()->get("form_input");

        if (!$input) {
            return redirect('item/create');
        }

        return view('items/confirm', ["input" => $input]);
    }
    public function send(Request $request)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect('item/create')
                ->withInput($input);
        }

        if (!$input) {
            return redirect('items/create');
        }
        // register operation

        $request->session()->forget('form_input');
        return redirect('item/complete');
    }
    public function complete()
    {
        return view('items/complete');
    }
}
