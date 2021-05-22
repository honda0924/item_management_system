<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $cartElements = ["user_id", "product_id", "item_num"];
    //
    public function show($user_id)
    {
        $carts = DB::table('cart')
            ->join('items', 'cart.product_id', '=', 'items.id')
            ->select('cart.id as id', 'cart.user_id as user_id', 'cart.item_num as item_num', 'items.product_name as product_name', 'items.price as price')
            ->where('cart.user_id', $user_id)->get();
        return view('cart/show', ["carts" => $carts]);
    }

    public function add(Request $request)
    {
        $input = $request->only($this->cartElements);
        $validator = [
            "user_id" => "required|integer",
            "product_id" => "required|integer",
            "item_num" => "required|integer",
        ];

        $request->validate($validator);

        try {
            //code...
            DB::table('cart')->insert(
                [
                    'user_id' => $input["user_id"],
                    'product_id' => $input["product_id"],
                    'item_num' => $input["item_num"],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            $resMsg = now() . 'に商品をカートに追加しました';
            return Response($resMsg, Response::HTTP_OK);
        } catch (\Exception $e) {
            return Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete($id)
    {
        try {
            DB::table('cart')->where('id', $id)->delete();
            return Response($id, Response::HTTP_OK);
        } catch (\Exception $e) {
            return Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function purchase()
    {
        $carts = DB::table('cart')
            ->select('user_id', 'product_id', 'item_num', 'created_at')
            ->where('user_id', Auth::user()["id"])->get();
        $buy_items = array();
        foreach ($carts as $cart) {
            $element = [
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'item_num' => $cart->item_num,
                'created_at' => now(),
            ];
            array_push($buy_items, $element);
        }
        DB::transaction(function () use ($buy_items) {
            DB::table('buy_items')->insert($buy_items);
            DB::table('cart')->where('user_id', Auth::user()["id"])->delete();
        });
        return redirect('/items');
    }
}
