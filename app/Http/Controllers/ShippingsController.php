<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

use App\Models\Shipping;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class ShippingsController extends Controller
{
    //
    private $shippingElements = ["name", "address", "tel"];
    private $shippingEditElements = ["id", "name", "address", "tel"];

    public function index()
    {
        // $shippings = DB::table('shippings')->paginate(5);
        $shippings = Shipping::paginate(5);

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
        try {
            DB::beginTransaction();
            $shipping->name = $input["name"];
            $shipping->address = $input["address"];
            $shipping->tel = $input["tel"];
            $shipping->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
            exit;
        }




        $request->session()->forget('edit_input');
        return redirect('shipping/edit_complete');
    }
    public function edit_complete()
    {
        return view('shippings/edit_complete');
    }
    public function create()
    {
        return view('shippings/create');
    }
    public function add(Request $request)
    {
        $input = $request->only($this->shippingElements);
        $validator = [
            "name" => "required|string",
            "address" => "required|string",
            "tel" => "required|string",
        ];

        $request->validate($validator);

        try {
            DB::transaction();
            DB::table('shippings')->insert(
                [
                    'name' => $input["name"],
                    'address' => $input["address"],
                    'tel' => $input["tel"],
                    'created_at' => now(),
                ]
            );
            DB::commit();
            $resMsg = now() . 'に' . $input['name'] . 'を出荷先に追加しました';
            return Response($resMsg, Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
