<?php
// Added Amit on 02-03-2017
// New ResetPasswordController for 'Admin' section

namespace App\Http\Controllers\Adminauth;

use App\Http\Controllers\admin\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
class ResetPasswordController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }
	
	public function showResetPasswordForm(Request $request, $token = null) {
		return view('admin.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
	}
	
	public function reset(Request $request) {
        $this->validate($request,$this->rules(),$this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request),function($user,$password){
                $this->resetPassword($user,$password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($response)
                    : $this->sendResetFailedResponse($request,$response);
    }
	
	protected function rules() {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }
	
	protected function validationErrorMessages() {
        return [];
    }
	
	public function broker() {
        return Password::broker('admins');
    }
	
	protected function credentials(Request $request) {
        return $request->only(
            'email','password','password_confirmation','token'
        );
    }
	
	protected function resetPassword($user,$password) {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();
        $this->guard()->login($user);
    }
	
	protected function sendResetResponse($response) {
        return redirect($this->redirectPath())
                            ->with('status',trans($response));
    }
	
	protected function sendResetFailedResponse(Request $request,$response) {
        return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
    }
	
	protected function guard() {
        return Auth::guard('admin');
    }
}