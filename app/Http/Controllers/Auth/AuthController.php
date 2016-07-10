<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Validator;
use App\OAuthUser;
use Illuminate\Support\Facades\Redirect;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Hash;

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

        $newUser = new User();
        $newUser->name = $data['name'];
        $newUser->email = $data['email'];
        $newUser->password = bcrypt($data['password']);
        $newUser->avatar = Gravatar::src($data['email'], 50);
        $newUser->save();
        return $newUser;
    }


    /**
     * Redirect to provider Login
     * @return mixed
     */
    public function loginWithProvider($provider)
    {
        if (!in_array($provider, ['google', 'facebook', 'bitbucket', 'github'])) {
            abort(404);
        }

        $scopes = [
            'google'    => ['profile'],
            'facebook'  => ['public_profile'],
            'github'    => ['user'],
        ];

        return Socialite::driver($provider)->redirect();
//        return Socialite::driver($provider)->scopes($scopes[$provider])->redirect();
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
            return redirect()->route('home');
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

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            return $existingUser;
        } else {

            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->password = $this->generatePassword();
            $newUser->avatar = $user->avatar;
            $newUser->save();

            return $newUser;

        }
    }

    private function generatePassword()
    {
        return bcrypt(Hash::make(str_random(16)));
    }
}
