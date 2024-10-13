<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function fetchUsers(Request $req)
    {
        $users = User::when(!empty($req['id']), function ($q) use ($req) {
            return $q->where('id', $req['id']);
        })->when(!empty($req['name']), function ($q) use ($req) {
            return $q->where('name', 'LIKE', '%' . $req['name'] . '%');
        })->when(!empty($req['email']), function ($q) use ($req) {
            return $q->where('email', 'LIKE', '%' . $req['email'] . '%');
        })->get()->toArray();
        return response($users);
    }
}
