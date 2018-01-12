<?php

namespace App\Http\Controllers\Companyauth;

use App\Http\Controllers\company\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

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
    protected $redirectTo = '/company';
	protected $guard = 'company';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:company', ['except' => 'logout']);
    }
	
	public function showLoginForm() {
		if(Auth::guard('company')->check()){
			return redirect('/company/dashboard');
		}
		return view('company.auth.login');
	}
	
	public function companyLogin(Request $request) {
		$this->validateLogin($request);
        if(isset($request['email']) && isset($request['password'])){
            $auth = auth()->guard('company');
            $credentials = [
                'company_email' =>  $request['email'],
                'password' =>  $request['password'],
            ];
            if($auth->attempt($credentials)){
                 return redirect()->action('company\DashboardController@joblist');                     
            }else{
                return $this->sendFailedLoginResponse($request);
            }
        }else{
            return view('company.auth.login');
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
		return view('company.auth.register');
	}
	
	public function logout(Request $request) {
		Auth::guard('company')->logout();
		return redirect('/company/login');
	}
	
}
