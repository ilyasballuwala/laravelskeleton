<?php
// Added Amit on 02-03-2017
// New LoginController for 'Admin' section

namespace App\Http\Controllers\Adminauth;

use App\Http\Controllers\admin\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller {
    
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
    
	protected $redirectTo = '/admin';
	protected $guard = 'admin';
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }
	
	public function showLoginForm() {
		if(Auth::guard('admin')->check()){
			return redirect('/admin');
		}
		return view('admin.auth.login');
	}
	
	public function adminLogin(Request $request) {
		$this->validateLogin($request);
        if(isset($request['email']) && isset($request['password'])){
            $auth = auth()->guard('admin');
            $credentials = [
                'email' =>  $request['email'],
                'password' =>  $request['password'],
            ];
            if($auth->attempt($credentials)){
                 return redirect()->action('admin\DashboardController@index');                     
            }else{
                return $this->sendFailedLoginResponse($request);
            }
        }else{
            return view('admin.auth.login');
        }
    }
	
	protected function validateLogin(Request $request) {
        $this->validate($request,[
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);
    }
	
	public function loginUsername() {
        return property_exists($this,'username') ? $this->username : 'email';
    }
	
	protected function sendFailedLoginResponse(Request $request) {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
	
	protected function getFailedLoginMessage() {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }
	
	public function showRegistrationForm() {
		return view('admin.auth.register');
	}
	
	public function logout() {
		Auth::guard('admin')->logout();
		return redirect('/admin/login');
	}
}