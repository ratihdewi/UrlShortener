<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\FlashMessage;
use Auth;
use Session;
use GuzzleHttp\Client;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // $login_url = 'https://sso.universitaspertamina.ac.id/sso-login?redirect_url=https://pengadaan.universitaspertamina.ac.id/auth';
        // $login_url = 'https://sso-dev.universitaspertamina.ac.id/sso-login?redirect_url=http://localhost:8000/auth';
         $login_url = 'https://sso.universitaspertamina.ac.id/sso-login?redirect_url=https://sandra.universitaspertamina.ac.id/auth';
        return \Redirect::to($login_url);
    }

    public function auth()
    {
        if(isset($_GET['username'])){
            $username = $_GET['username'];
            $token_login = $_GET['token'];

            setcookie('username', $username, time() + (86400 * 30), "/"); 
            setcookie('token_login', $token_login, time() + (86400 * 30), "/");

            $user = User::where('username', $username)->first();
            $user = User::find($user->id);
            
            Auth::attempt(['email' => $user->email, 'password' => $user->password_real]);
            return redirect()->intended('procurement');
        } else {
            // $login_url = 'https://sso.universitaspertamina.ac.id/sso-login?redirect_url=https://pengadaan.universitaspertamina.ac.id/auth';
            // $login_url = 'https://sso-dev.universitaspertamina.ac.id/sso-login?redirect_url=http://localhost:8000/auth';
             $login_url = 'https://sso.universitaspertamina.ac.id/sso-login?redirect_url=https://sandra.universitaspertamina.ac.id/auth';
            return \Redirect::to($login_url);
        }
    }
    
    public function logout(Request $request)
    {
        Session::flush();
        if (isset($_COOKIE['token_login']) || isset($_COOKIE['username'])) {
            $token_login = $_COOKIE['token_login'];
            $username = $_COOKIE['username'];
            if (isset($_SERVER['HTTP_COOKIE'])){
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                foreach ($cookies as $cookie){
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    setcookie($name, '', time() -1000);
                    setcookie($name, '', time() -1000, '/');
                }
            }
            // $logout_url = 'https://sso-dev.universitaspertamina.ac.id/sso-logout?token='.$token_login.'&username='.$username;
            $logout_url = 'https://sso.universitaspertamina.ac.id/sso-logout?token='.$token_login.'&username='.$username;
        return \Redirect::to($logout_url);
        }
        // $username = $_COOKIE["username"];
        // $token_login = $_COOKIE["token_login"];

        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // setcookie('username', $username, time() - 3600, '/');
        // setcookie('token_login', $token_login, time() - 3600, '/');
    
        // $logout_url = 'https://sso.universitaspertamina.ac.id/sso-logout?token='.$token_login.'&username='.$username;
        // return \Redirect::to($logout_url);
    }


    public function getToken()
    {
        $username = $_COOKIE["username"];
        $token_login = $_COOKIE["token_login"];

        //memo
        $client = new Client([
            // 'base_uri' => 'https://sso-dev.universitaspertamina.ac.id/',
            'base_uri' => 'https://sso.universitaspertamina.ac.id/',
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $responses = $client->get('sso-check?token='.$token_login.'&username='.$username);
        $result = json_decode($responses->getBody(), true);
        if($result){
            echo "masih login";
        } else {
            echo "udah ga login";
        }
    }
}
