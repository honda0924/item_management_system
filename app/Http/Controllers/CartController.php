<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    private $cartElements = ["user_id", "product_id", "item_num"];
    //
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
}
