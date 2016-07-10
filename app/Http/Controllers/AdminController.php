<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;

class AdminController extends Controller
{
    public function __construnct()
    {
        $this->middleware('auth');

    }


    public function dashboard()
    {
        return View('admin/index', $this->getUsers());
    }

    public function users()
    {

        $data = $this->getUsers();
        return View('admin/users', $data);
    }


    public function user(Request $request, User $user)
    {
        // if the current user is root, allow all roles
        // if the current user is administrator, only administrator and guest roles are allowed

        if ($user->hasRole('Root') && Auth::user()->hasRole('Administrator')) {
            // Administrators should not be able to change Root users stuff
            return redirect('/admin/users');
        }

        $roles = Role::all();
        $formRoles = [];

        foreach ($roles as $role) {
            $formRoles[$role->id] = $role->name;
        }

        if (!$request->user()->hasRole('Root')) {
            unset($formRoles[3]);
        }


        return View('admin/user/edit', ['user' => $user, 'roles' => $formRoles]);
    }

    public function userUpdate(Request $request, User $user)
    {
        // validations

        $user->email = $request->email;
        $user->name = $request->name;
        if (strlen($request->password) > 7) {
            $user->password = bcrypt($request->password);
        }
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->avatar = Gravatar::src($request->email, 50);
        $user->update();


        return redirect('/admin/users');
    }

    /**
     * @return array
     */
    private function getUsers()
    {
        if (Auth::user()->hasRole('Root')) {
            $data = ['users' => User::all()];
            return $data;
        } else {
            $data = ['users' => User::where('role_id', '<', '3')->get()];
            return $data;
        }
    }

}
