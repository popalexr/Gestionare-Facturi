<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::all();

        return view('users.users-index')->with([
            'users' => $users
        ]);
    }
}
