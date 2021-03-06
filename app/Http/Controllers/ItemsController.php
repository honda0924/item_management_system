<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Validator;

class ItemsController extends Controller
{
    private $itemElements = ["product_name", "arrival_source", "manufacturer", "price", "email", "tel"];
    private $itemEditElements = ["id", "product_name", "arrival_source", "manufacturer", "price"];

    public function index()
    {
        $keyword = request('keyword');
        $sort_key = request('sort') ? explode('-', request('sort')) : ['id', 'asc'];
        $items = DB::table('items')
            ->leftJoin('favorite', 'favorite.product_id', '=', 'items.id')
            ->select(DB::raw('items.id as id, items.product_name as product_name, items.arrival_source as arrival_source, items.manufacturer as manufacturer,items.price as price, items.created_at as created_at, items.updated_at as updated_at, count(favorite.user_id=?) as is_favorite'))
            ->setBindings([Auth::user()["id"]])
            ->groupBy('items.id')
            ->where('items.product_name', 'like', '%' . $keyword . '%')
            ->orWhere('items.arrival_source', 'like', '%' . $keyword . '%')
            ->orWhere('items.manufacturer', 'like', '%' . $keyword . '%')
            ->orderBy($sort_key[0], $sort_key[1])
            ->paginate(5);

        return view('items/index', compact('items'));
    }

    public function create()
    {
        return view('items/create');
    }
    public function post(ItemRequest $request)
    {
        $input = $request->only($this->itemElements);
        $request->session()->put("form_input", $input);

        return redirect('item/confirm');
    }
    public function confirm(Request $request)
    {
        $input = $request->session()->get("form_input");

        if (!$input) {
            return redirect('item/create');
        }

        return view('items/confirm', compact("input"));
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

        $reg_info = now() . '???' . $input['email'] . '????????????????????????';
        DB::beginTransaction(); //?????????????????????????????????
        try {
            //DB?????????????????????try?????????????????????
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
            DB::commit(); //?????????????????????????????????????????????DB?????????
        } catch (\Exception $e) {
            DB::rollBack(); //?????????????????????????????????DB??????????????????????????????
            Log::info($e); //???????????????????????????????????????????????????????????????????????????????????????
            exit;
        }




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
            "price" => "required|integer",
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
        $item->price = $input["price"];
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
