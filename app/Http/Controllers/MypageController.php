<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MypageController extends Controller
{
    //
    public function index()
    {
        $user = User::find(Auth::user()["id"]);
        $logs = DB::table('logs')->get();
        $favorites = DB::table('items')->join('favorite', 'items.id', '=', 'favorite.product_id')->where('user_id', Auth::user()["id"])->get();
        return view('mypage/index')->with(['user' => $user, 'logs' => $logs, 'favorites' => $favorites]);
    }
}
