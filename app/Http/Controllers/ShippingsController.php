<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Shipping;


class ShippingsController extends Controller
{
    //
    private $shippingElements = ["name", "address", "tel"];
    private $shippingEditElements = ["id", "name", "address", "tel"];

    public function index()
    {
        $shippings = DB::table('shippings')->paginate(5);

        return view('shippings/index', ['shippings' => $shippings]);
    }

    public function complete()
    {
        return view('shippings/complete');
    }
    public function delete($id)
    {
        Shipping::find($id)->delete();
        return redirect('shippings');
    }
    public function edit($id)
    {
        $shipping = Shipping::find($id);
        return view('shippings/edit')->with('shipping', $shipping);
    }
    public function edit_post(Request $request)
    {
        $input = $request->only($this->shippingEditElements);
        $validator = [
            "id" => "required|integer",
            "name" => "required|string",
            "address" => "required|string",
            "tel" => "required|string",
        ];

        $request->validate($validator);
        $request->session()->put("edit_input", $input);

        return view('shippings/edit_confirm', ["input" => $input]);
    }
    public function update(Request $request)
    {
        $input = $request->session()->get('edit_input');

        if ($request->has('back')) {
            return redirect('shipping/edit/{{ $input["id"] }}')
                ->withInput($input);
        }

        // register operation
        $shipping = Shipping::find($input["id"]);

        $shipping->name = $input["name"];
        $shipping->address = $input["address"];
        $shipping->tel = $input["tel"];
        $shipping->updated_at = now();
        $shipping->save();



        $request->session()->forget('edit_input');
        return redirect('shipping/edit_complete');
    }
    public function edit_complete()
    {
        return view('shipping/edit_complete');
    }
    public function create()
    {
        return view('shippings/create');
    }
}
