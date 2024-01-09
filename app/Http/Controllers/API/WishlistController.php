<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function wishlist(Request $request)
    {
        $user = Auth::user();
        $itemwishlist = Wishlist::where('id_user', $user->id)->with('loker')->get();
        return response()->json(['message' => 'Success', 'code' => '200', 'data' => $itemwishlist]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'loker_id'     => 'required',
            'pelamar_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Failed', 'code' => '300']);
        }
        $validasiwishlist = Wishlist::where('loker_id', $request->loker_id)->where('id_user', $user->id)->first();
        if ($validasiwishlist) {
            $validasiwishlist->delete();
            return response()->json(['message' => 'Success Remove Wishlist', 'code' => 'reg1']);
        } else {
            $itemwishlist = Wishlist::create([
                'id_user' => $user->id,
                'loker_id' => $request->loker_id,
                'pelamar_id' => $request->pelamar_id
            ]);
            return response()->json(['message' => 'Move To Wishlist Success', 'code' => 'reg2', 'data' => $itemwishlist]);
        }
    }
}

