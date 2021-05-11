<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MypageController extends Controller
{
    //
    public function index()
    {
        $logs = DB::table('logs')->get();
        return view('mypage/index', ['logs' => $logs]);
    }
}
