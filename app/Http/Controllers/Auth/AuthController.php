<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Redirect;
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
        ]);
    }


    /**
     * Redirect to Google Login
     * @return mixed
     */
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return Redirect::to('auth/google');
        }

        $authUser = $this->findOrCreateGoogleUser($user);

        Auth::login($authUser, true);
        return redirect()->route('dashboard_home');
    }

    /**
     * Return user if exists; create and return if not
     *
     * @param $googleUser
     * @return User
     */
    private function findOrCreateGoogleUser($googleUser)
    {


        $authUser = User::where('email', $googleUser->email)->first();

        if (!$authUser) {
            // this user MAY already have an ac, either signed in via Facebook
            // or by already registering.

            return User::create([
                'name'      => $googleUser->name,
                'email'     => $googleUser->email,
                'password'  => $this->generatePassword(),
                'google_id' => $googleUser->id,
                'avatar'    => $googleUser->avatar
            ]);
        }

        if ($authUser->google_id === $googleUser->id) {
            return $authUser;
        }

        $authUser->google_id = $googleUser->id;
        $authUser->avatar = $googleUser->avatar;
        $authUser->save();

        return $authUser;
    }

    /*
     * FACEBOOK LOGIN
     */



    /**
     * Redirect to Facebook Login
     * @return mixed
     */
    public function loginWithFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }



    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleFacebookProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();

        } catch (\Exception $e) {
            return Redirect::to('auth/facebook');
        }

        $authUser = $this->findOrCreateFacebookUser($user);

        Auth::login($authUser, true);
        return redirect()->route('dashboard_home');
    }

    /**
     * Return user if exists; create and return if not
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateFacebookUser($facebookUser)
    {


        $authUser = User::where('email', $facebookUser->email)->first();

        if (!$authUser) {
            // this user MAY already have an ac, either signed in via Facebook
            // or by already registering.

            return User::create([
                'name'      => $facebookUser->name,
                'email'     => $facebookUser->email,
                'password'  => $this->generatePassword(),
                'facebook_id' => $facebookUser->id,
                'avatar'    => $facebookUser->avatar
            ]);
        }

        if ($authUser->facebook_id === $facebookUser->id) {
            return $authUser;
        }

        $authUser->facebook_id = $facebookUser->id;
        $authUser->avatar = $facebookUser->avatar;
        $authUser->save();

        return $authUser;

    }


    /*
     * TWITTER LOGIN
     */



    /**
     * Redirect to Twitter Login
     * @return mixed
     */
    public function loginWithTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }



    /**
     * Obtain the user information from Twitter.
     *
     * @return Response
     */
    public function handleTwitterProviderCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();

        } catch (\Exception $e) {
            return Redirect::to('auth/twitter');
        }

        $authUser = $this->findOrCreateTwitterUser($user);

        Auth::login($authUser, true);

        return redirect()->route('dashboard_home');
    }

    /**
     * Return user if exists; create and return if not
     *
     * @param $twitterUser
     * @return User
     */
    private function findOrCreateTwitterUser($twitterUser)
    {

        $authUser = User::where('email', $twitterUser->email)->first();

        if (!$authUser) {
            // this user MAY already have an ac, either signed in via Facebook
            // or by already registering.


            return User::create([
                'name'      => $twitterUser->name,
                'email'     => $twitterUser->nickname . '@twitter.com',
                'password'  => $this->generatePassword(),
                'twitter_id' => $twitterUser->id,
                'avatar'    => $twitterUser->avatar
            ]);
        }

        if ($authUser->twitter_id === $twitterUser->id) {
            return $authUser;
        }

        $authUser->twitter_id = $twitterUser->id;
        $authUser->avatar = $twitterUser->avatar;
        $authUser->save();

        return $authUser;

    }

    private function generatePassword()
    {
        return Hash::make(str_random(16));
    }
}
