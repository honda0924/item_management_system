<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
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

        $reg_info = now() . 'に' . $input['email'] . 'が商品追加を実施';
        DB::transaction(function () use ($input, $reg_info) {
            DB::table('items')->insert(
                [
                    'product_name' => $input["product_name"],
                    'arrival_source' => $input["arrival_source"],
                    'manufacturer' => $input["manufacturer"],
                    'created_at' => now(),
                    'updated_at' => now(),

                ]
            );
            DB::table('logs')->insert(
                [
                    'email' => $input["email"],
                    'tel' => $input["tel"],
                    'information' => $reg_info,
                ]
            );
        });



        $request->session()->forget('form_input');
        return redirect('item/complete');
    }
    public function complete()
    {
        return view('items/complete');
    }
}
