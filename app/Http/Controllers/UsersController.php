<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    private $userEditElements = ["id", "name", "email", "login_id", "password", "updated_at"];

    public function edit_post(Request $request)
    {
        $input = $request->only($this->userEditElements);
        $validator = [
            "id" => "required|integer",
            "name" => "required|string",
            "email" => "required|string",
            "login_id" => "required|integer",
        ];

        $request->validate($validator);
        $request->session()->put("user_edit_input", $input);

        return view('user/edit_confirm', ["input" => $input]);
    }
    public function update(Request $request)
    {
        $input = $request->session()->get('user_edit_input');

        if ($request->has('back')) {
            return redirect('mypage');
        }

        if (!$input) {
            return redirect('mypage');
        }
        // register operation
        $user = User::find($input["id"]);

        $user->login_id = $input["login_id"];
        $user->name = $input["name"];
        $user->email = $input["email"];
        $user->updated_at = now();
        $user->save();



        $request->session()->forget('user_edit_input');
        return redirect('user/edit_complete');
    }
    public function edit_complete()
    {
        return view('user/edit_complete');
    }
}
