<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function allUsers()
    {
        $cesaeInfo = $this->getCesaeInfo();
        $allContacts = $this->getContacts();

        //função para inserir um user na bd. corre quando chamamos a rota cuja presente função está associada
        //$this->insertUserIntoDB();

        $allUsers = $this->getAllUsersFromDB();
        return view('users.all_users', compact('cesaeInfo', 'allContacts', 'allUsers'));
    }

    public function addUsers()
    {
        return view('users.add_users');
    }

    public function insertUserIntoDB()
    {
        DB::table('users')
            ->insert([
                'name' => 'Sara Monteiro',
                'email' => 'myemaildd2@gmail.com',
                'password' => '133444'
            ]);

        return response()->json('utilizador inserido');
    }

    public function viewUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        return view('users.view_user', compact('user'));
    }

    public function deleteUserFromDB($id)
    {
        db::table('tasks')->where('user_id', $id)->delete();
        db::table('users')->where('id', $id)->delete();

        return back();

    }

    private function getCesaeInfo()
    {
        $cesaeInfo = [
            'name' => 'Cesae',
            'email' => 'Cesae@gmail.com',
            'address' => 'Rua do CesAE',
        ];

        return $cesaeInfo;
    }

    protected function getContacts()
    {
        $contacts = [
            ['id' => 1, 'name' => 'Sara', 'phone' => '912222222'],
            ['id' => 2, 'name' => 'Bruno', 'phone' => '912222222'],
            ['id' => 3, 'name' => 'Márcia', 'phone' => '912222222'],
        ];

        return $contacts;
    }

    public function updateUserAtDB()
    {

        Db::table('users')
            ->where('id', 3)
            ->update([
                'address' => 'Rua Nova do Bruno',
                'updated_at' => now(),
            ]);
    }

    protected function getAllUsersFromDB()
    {

        $users = Db::table('users')
            ->select('name', 'email', 'password', 'id')
            ->get();


        return $users;
    }

    protected function deleteUser($id)
    {
        Db::table('users')
            ->where('id', $id)
            ->delete();

    }

    public function createUser(request $request)
    {

        $request->validate([
            'name' => 'required | string | min:3',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:8'
        ]);

        User::insert([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password)
        ]);

        return redirect () ->route('users.show') -> with('message', 'user adicionado com sucesso');
    }


}
