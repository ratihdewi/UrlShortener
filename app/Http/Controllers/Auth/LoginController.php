<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Client;
use App\Models\User;
use Auth;
use Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function showLoginForm()
    {
        $login_url = 'https://sso-dev.universitaspertamina.ac.id/sso-login?redirect_url=http://localhost/proc/public/auth';
        header('Location: '.$login_url);
        die;
    }

    public function auth()
    {
        $username = $_GET['username'];
        $token_login = $_GET['token'];

        setcookie('username', $username, time() + (86400 * 30), "/"); setcookie('token_login', $token_login, time() + (86400 * 30), "/");

        $user = User::where('username', $username)->first();
        $user = User::find($user->id);
        
        Auth::attempt(['email' => $user->email, 'password' => $user->password_real]);
        return redirect()->route('procurement.index');
    }

    

    
    public function getToken()
    {
        $username = $_COOKIE["username"];
        $token_login = $_COOKIE["token_login"];

        //memo
        $client = new Client([
            'base_uri' => 'https://sso-dev.universitaspertamina.ac.id/',
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $responses = $client->get('sso-check?token='.$token_login.'&username='.$username);
        $result = json_decode($responses->getBody(), true);
        if($result){
            echo "masih login";
        } else {
            echo "udah ga login";
        }
    }*/
}
