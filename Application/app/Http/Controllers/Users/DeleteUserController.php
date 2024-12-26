<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DeleteUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->query('id', 0);

        if ($id == 0) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        $user = User::find($id);

        if (blank($user) || !blank($user->deleted_at)) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        $user->deleted_at = now(); // Soft delete the user

        $user->save();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
