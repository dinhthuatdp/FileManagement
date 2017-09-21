<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\YoloController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\DBController;

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

    public $conn = null;
    public function __constructor(){
        
        
    }
    public function login(Request $request) {
        try {
            $ylController = new YoloController();
            
            $items = $ylController->getM_MajorFile();
            
            $userName = $request['userName'];
            $password = $request['password'];
            $users = $ylController->getAllUsers();
            $result = $users->where('user_name', $userName)
                    ->where('password', $password);
            if($result->count() > 0) {
                //session()->put('sessionLogin', $result);
                session()->put('sessionLogin',[$result->first()->user_name, $result->first()->id]);
                
                //var_dump('session: '.session()->get('sessionLogin'));
                //exit();
                //session()->forget('sessionLogin');
                return view('welcome', compact('id', 'items'));
            }
            return view("login");
        } catch (\Exception $e) {
            return "error ".$e->getMessage();
        }
    }
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
