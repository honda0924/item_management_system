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
    private $itemEditElements = ["id", "product_name", "arrival_source", "manufacturer"];

    public function index()
    {
        // $items = Item::paginate(5);
        $items = DB::select(
            'select items.id as id, items.product_name as product_name, items.arrival_source as arrival_source, items.manufacturer as manufacturer,items.created_at as created_at,items.updated_at as updated_at, 
            count(favorite.user_id=?) as is_favorite 
            from items 
            left join favorite
            on items.id = favorite.product_id 
            group by items.id',
            [Auth::user()["id"]]
        );
        // $items = DB::table('items')
        //     ->leftJoin('favorite', 'favorite.product_id', '=', 'items.id')
        //     ->select('items.id as id', 'items.product_name as product_name', 'items.arrival_source as arrival_source', 'items.manufacturer as manufacturer', 'items.created_at as created_at', 'items.updated_at as updated_at', 'count(favorite.user_id={{ Auth::user()["id"] }})')
        //     ->groupBy('items.id')
        //     ->paginate(5);

        return view('items/index', ['items' => $items]);
    }

    public function create()
    {
        return view('items/create');
    }
    public function post(Request $request)
    {
        $input = $request->only($this->itemElements);
        $validator = [
            "product_name" => "required|string",
            "arrival_source" => "nullable|string",
            "manufacturer" => "nullable|string",
            "email" => "required|string|email:strict,dns",
            "tel" => "required|regex:/^[0-9\-]+$/i",
        ];

        $request->validate($validator);
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
    public function delete($id)
    {
        Item::find($id)->delete();
        return redirect('items');
    }
    public function edit($id)
    {
        $item = Item::find($id);
        return view('items/edit')->with('item', $item);
    }
    public function edit_post(Request $request)
    {
        $input = $request->only($this->itemEditElements);
        $validator = [
            "id" => "required|integer",
            "product_name" => "required|string",
            "arrival_source" => "nullable|string",
            "manufacturer" => "nullable|string",
        ];

        $request->validate($validator);
        $request->session()->put("edit_input", $input);

        return view('items/edit_confirm', ["input" => $input]);
    }
    public function update(Request $request)
    {
        $input = $request->session()->get('edit_input');

        if ($request->has('back')) {
            return redirect('item/edit/{{ $input["id"] }}')
                ->withInput($input);
        }

        if (!$input) {
            return redirect('items/create/{{ $input["id"] }}');
        }
        // register operation
        $item = Item::find($input["id"]);

        $item->product_name = $input["product_name"];
        $item->arrival_source = $input["arrival_source"];
        $item->manufacturer = $input["manufacturer"];
        $item->updated_at = now();
        $item->save();



        $request->session()->forget('edit_input');
        return redirect('item/edit_complete');
    }
    public function edit_complete()
    {
        return view('items/edit_complete');
    }
}
