<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Redirect;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected $redirectPath = '/dashboard';
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => Gravatar::src($data['email'], 50)
        ]);
    }


    /**
     * Redirect to Google Login
     * @return mixed
     */
    public function loginWithProvider($provider)
    {
        if (!in_array($provider, ['google', 'facebook', 'twitter'])) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }


    /**
     * Obtain the user information from the provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return Redirect::to('auth/' . $provider);
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);
        return redirect()->route('dashboard_home');
    }



    /**
     * Return user if exists; create and return if not
     *
     * @param $user
     * @return User
     */
    private function findOrCreateUser($user, $provider)
    {

        if ($provider == 'twitter') {
            $user->email = $user->nickname . '@twitter.com';
        }

        $authUser = User::where('email', $user->email)->first();

        if (!$authUser) {
            // this user MAY already have an ac, either signed in via a different
            // provider, or by already registering.

            return User::create([
                'name'      => $user->name,
                'email'     => $user->email,
                'password'  => $this->generatePassword(),
                $provider . '_id' => $user->id,
                'avatar'    => $user->avatar
            ]);
        }

        if ($authUser->{$provider . '_id'} === $user->id) {
            return $authUser;
        }

        $authUser->{$provider . '_id'} = $user->id;
        $authUser->avatar = $user->avatar;
        $authUser->save();

        return $authUser;
    }


    private function generatePassword()
    {
        return bcrypt(Hash::make(str_random(16)));
    }
}
