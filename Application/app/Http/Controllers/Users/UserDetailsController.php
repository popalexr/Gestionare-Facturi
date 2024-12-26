<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserDetailsController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->query('id');

        $user = $this->getUserDetails($id);

        if (blank($user) || !blank($user->deleted_at))
            return redirect()->route('users.index')->with('error', 'This user doesn\'t exist.');

        return view('users.users-details', compact('user'));
    }

    private function getUserDetails($id)
    {
        return User::find($id);
    }
}
