<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Google_Client;
use Google_Service_People;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

   /**
     * Obtain the user information from provider and log in the user.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            abort(403, 'Unauthorized action.');
            return redirect()->to('/');
        }
        $attributes = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar(),

        ];

        $user = User::where('provider_id', $user->getId() )->first();
        
        if (!$user){
            try{
                $user=  User::create($attributes);
            }catch (ValidationException $e){
              return redirect()->to('/home');
            }
        }

        $this->guard()->login($user);
        return redirect()->to($this->redirectTo);

    }        
}
