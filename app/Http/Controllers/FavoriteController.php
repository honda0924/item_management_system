<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    //
    public function add($id)
    {
        DB::table('favorite')->insert(
            [
                'user_id' => Auth::user()["login_id"],
                'product_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        return redirect('items');
    }
    public function delete($id)
    {
        DB::table('favorite')->where('user_id', Auth::user()["id"])->where('product_id', $id)->delete();
        return redirect('items');
    }
}
