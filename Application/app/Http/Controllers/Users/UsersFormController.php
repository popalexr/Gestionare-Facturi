<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersFormController extends Controller
{
    private int $id;

    public function __invoke(Request $request)
    {
        $this->id = $request->query('id', 0);

        $permissions = $this->getPermissions();

        if($this->id === 0)
        {
            return view('users.add-users')->with([
                'permissions' => $permissions
            ]);
        }

        if (!$this->userExists($this->id))
        {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        $user = User::find($this->id);

        return view('users.edit-users')->with([
            'permissions' => $permissions,
            'user' => $user
        ]);
    }

    public function post(Request $request)
    {
        $this->id = $request->query('id', 0);

        $request->validate($this->getValidationRules(is_editing:$this->userExists($this->id)), $this->getValidationMessages());

        if(!$this->userExists($this->id))
            $this->id = $this->addUser($request);

        $this->editUser($request);

        return redirect()->route('users.details', ['id' => $this->id])->with('success', 'User has been saved successfully.');
    }

    /**
     * Function to get validation rules
     * 
     * @return array
     */
    private function getValidationRules(bool $is_editing): array
    {
        $email = 'required|string|email|max:255|unique:users,email';

        if ($is_editing)
        {
            $email = 'required|string|email|max:255' . $this->id;
        }

        return [
            'name'        => 'required|string|max:255',
            'email'       => $email,
            'phone'       => 'string|nullable',
            'admin'       => 'string',
            'permission'  => 'array'
        ];
    }

    /** Function to get validation error messages
     * 
     * @return array
     */
    private function getValidationMessages(): array
    {
        return [
            'name.required'     => 'Name is required',
            'name.max'          => 'Name is too long',
            'name'              => 'Name is invalid',
            'email.required'    => 'Email is required',
            'email.max'         => 'Email is too long',
            'email.unique'      => 'Email already exists',
            'email'             => 'Email is invalid',
            'phone'             => 'Phone is invalid',
            'admin'             => 'Admin is invalid',
            'permission'        => 'Permissions are invalid.'
        ];
    }

    /**
     * Get all permissions from config
     * 
     * @return array
     */
    private function getPermissions(): array
    {
        return config('permissions');
    }

    /**
     * Check if user exists
     * 
     * @param int $id
     * @return bool
     */
    private function userExists(int $id): bool
    {
        if ($id === 0)
            return false;

        $user = User::find($id);

        return !(blank($user) || !blank($user->deleted_at));
    }

    /**
     * Function to handle new user
     * 
     * @param Request $request
     */
    private function addUser(Request $request)
    {
        $permissions = $this->parsePermissions($request->input('permission', []));
        $password = bcrypt(Str::random(12));
        $role = 'user';

        if (!blank($request->input('admin')))
            $role = 'admin';

        $id = User::insertGetId([
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'phone'         => $request->input('phone'),
            'password'      => $password,
            'role'          => $role,
            'permissions'   => $permissions
        ]);

        return $id;
    }

    /**
     * Function to handle editing user
     * 
     * @param Request $request
     */
    private function editUser(Request $request)
    {
        $permissions = $this->parsePermissions($request->input('permission', []));
        $role = 'user';

        if (!blank($request->input('admin')))
            $role = 'admin';

        User::where('id', $this->id)->update([
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'phone'         => $request->input('phone'),
            'role'          => $role,
            'permissions'   => $permissions,
        ]);
    }

    /** 
     * Function to parse permissions from array
     * 
     * @param array
     * @return string
     */
    private function parsePermissions(array $permissions): string
    {
        $permissions = array_keys($permissions); // Get the keys of the permissions array

        return json_encode($permissions);
    }
}
