<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function allUsers()
    {
        $search = request()->query('search') ? request()->query('search') : null;
        $allUsers = $this->getAllUsersFromDB($search);
        return view('users.all_users', compact('allUsers') );
    }

    protected function getAllUsersFromDB($search)
    {
        $users = Db::table('users');

        if ($search) {
            $users = $users
                ->where('name', 'like', "%{$search}%")
                ->orwhere('email', 'like', "%{$search}%");
        }

        $users = $users->select('name', 'email', 'password', 'id')
            ->get();

        return $users;
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.add')->with('message', 'User adicionado com sucesso');
    }
    public function addUserForm()
    {
        return view('users.add_users');
    }


    public function viewUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('users.view_user', compact('user'));
    }

    public function deleteUserFromDB($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('users.all')->with('success', 'User deleted successfully');

    }


}
