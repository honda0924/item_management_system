<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Validator;

class ItemsController extends Controller
{
    private $itemElements = ["product_name", "arrival_source", "manufacturer", "price", "email", "tel"];


    public function index()
    {
        $items = Item::paginate(5);

        return view('items/index', ['items' => $items]);
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
DB::beginTransaction();//トランザクションの開始
try {
  //DBの一連の処理はtryの中に全て書く
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
  DB::commit();//問題なく全ての処理が完了すればDBに反映
} catch (\Exception $e) {
  DB::rollBack();//エラーが発生した場合はDBのロールバックを行う
  \Log::info($e);//リリース後のことを考えてログにエラーは吐き出しておくのが吉
  exit;
}

            DB::table('items')->insert(
                [
                    'product_name' => $input["product_name"],
                    'arrival_source' => $input["arrival_source"],
                    'manufacturer' => $input["manufacturer"],
                    'price' => $input["price"],
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
