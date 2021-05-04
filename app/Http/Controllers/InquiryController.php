<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    private $inquiryElements = ["inquirer_name", "email", "tel", "inquiry_text"];
    //
    public function index()
    {
        return view('inquiry/index');
    }
    public function post(Request $request)
    {
        $input = $request->only($this->inquiryElements);
        $validator = [
            "inquirer_name" => "required|string",
            "email" => "required|string|email:strict,dns",
            "tel" => "required|regex:/^[0-9\-]+$/i",
            "inquiry_text" => "required|string",
        ];

        $request->validate($validator);
        $request->session()->put("inquiry_input", $input);

        return redirect('inquiry/confirm');
    }
    public function confirm(Request $request)
    {
        $input = $request->session()->get("inquiry_input");

        if (!$input) {
            return redirect('inquiry');
        }

        return view('inquiry/confirm', ["input" => $input]);
    }
    public function send(Request $request)
    {
        $input = $request->session()->get('inquiry_input');

        if ($request->has('back')) {
            return redirect('inquiry')
                ->withInput($input);
        }

        if (!$input) {
            return redirect('inquiry');
        }
        // register operation





        $request->session()->forget('inquiry_input');
        return redirect('inquiry/complete');
    }
    public function complete()
    {
        return view('inquiry/complete');
    }
}


// class ItemsController extends Controller
// {
//     private $itemElements = ["product_name", "arrival_source", "manufacturer", "email", "tel"];






//     public function send(Request $request)
//     {
//         $input = $request->session()->get('form_input');

//         if ($request->has('back')) {
//             return redirect('item/create')
//                 ->withInput($input);
//         }

//         if (!$input) {
//             return redirect('items/create');
//         }
//         // register operation

//         $reg_info = now() . 'に' . $input['email'] . 'が商品追加を実施';
//         DB::transaction(function () use ($input, $reg_info) {
//             DB::table('items')->insert(
//                 [
//                     'product_name' => $input["product_name"],
//                     'arrival_source' => $input["arrival_source"],
//                     'manufacturer' => $input["manufacturer"],
//                     'created_at' => now(),
//                     'updated_at' => now(),
//                 ]
//             );
//             DB::table('logs')->insert(
//                 [
//                     'email' => $input["email"],
//                     'tel' => $input["tel"],
//                     'information' => $reg_info,
//                 ]
//             );
//         });



//         $request->session()->forget('form_input');
//         return redirect('item/complete');
//     }
//     public function complete()
//     {
//         return view('items/complete');
//     }
// }
