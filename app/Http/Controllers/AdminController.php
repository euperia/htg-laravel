<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
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
        return View('admin/index', ['users' => User::count()]);
    }

    public function users()
    {

        $data = ['users' => User::paginate(20), 'userCount' => User::count()];
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

        // if current user is root, can't change own role.
        if ($user->id === Auth::user()->id && Auth::user()->hasRole('Root')) {
            unset($formRoles[1], $formRoles[2]);
        }

        return View('admin/user/edit', ['user' => $user, 'roles' => $formRoles]);
    }

    public function userUpdate(Request $request, User $user)
    {
        // validations
        $this->validate($request, [
            'name' => 'required|min:3|string',
            'email' => 'required|email',
            'password' => 'min:8',
        ]);

        // check if email address already exists.
        if (User::where('email', $request->email)->first()) {
            session()->flash('flash_message', [
                'level' => 'danger', 
                'msg' => 'That email address belongs to another account'
                ]
            );
            return redirect('/admin/user/' . $user->id);
        }
        

        $user->email = $request->email;
        $user->name = $request->name;
        if (strlen($request->password) > 7) {
            $user->password = bcrypt($request->password);
        }
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->update();

        Session::flash('flash_message', ['level' => 'success', 'msg' => 'Account updated OK']);
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
