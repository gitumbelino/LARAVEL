<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GiftController extends Controller
{
    public function index()
    {
        $gifts = $this->allGiftsFromDB();
        return view('gifts.all_gifts', compact('gifts'));
    }

    private function allGiftsFromDB()
    {
        $gifts = DB::table('gifts')
            ->join('users', 'gifts.user_id', '=', 'users.id')
            ->select('gifts.*', 'users.name as username',
                    DB::raw('(expected_value - spent_value) as value_difference'))
            ->get();

        return $gifts;
    }

    public function viewGift($id)
    {
        $gift = DB::table('gifts')
            ->join('users', 'gifts.user_id', 'users.id')
            ->where('gifts.id', $id)
            ->select('gifts.*', 'users.name as username',
                    DB::raw('(expected_value - spent_value) as value_difference'))
            ->first();

        $users = DB::table('users')->select('id', 'name')->get();

        return view('gifts.view_gift', compact('gift', 'users'));
    }

    public function deleteGiftFromDB($id)
    {
        DB::table('gifts')->where('id', $id)->delete();
        return back();
    }

    public function viewGiftForm()
    {
        $usersSelection = DB::table('users')->select('id', 'name')->get();
        return view('gifts.add_gift', compact('usersSelection'));
    }

    public function createGift(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'expected_value' => 'required|numeric|min:0',
            'spent_value' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id'
        ]);

        DB::table('gifts')->insert([
            'name' => $request->name,
            'expected_value' => $request->expected_value,
            'spent_value' => $request->spent_value,
            'user_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('gifts.all')->with('message', 'Prenda adicionada com sucesso');
    }

    public function updateGift(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'expected_value' => 'required|numeric|min:0',
            'spent_value' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id'
        ]);

        DB::table('gifts')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'expected_value' => $request->expected_value,
                'spent_value' => $request->spent_value,
                'user_id' => $request->user_id,
                'updated_at' => now()
            ]);

        return redirect()->route('gifts.all')->with('message', 'Prenda atualizada com sucesso');
    }
}
