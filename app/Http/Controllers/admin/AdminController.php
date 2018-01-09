<?php
// Added Amit on 03-02-2017
// New controller for Admin profile and change password page of admin

namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\admin\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Admin;
use Auth;
use Hash;
class AdminController extends Controller {
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('admin');
    }

    public function getChangePass() {
    	return view('admin.changepass',array('title' => 'Change Password'));
    }
	
	public function changePass(Request $request) {
		$messages = [
    		'currentpass.required' => 'The Current Password field is required.',
			'newpass.required' => 'The New Password field is required.',
			'newpass.min' => 'The New Password must be at least 6 characters.',
			'newpass.confirmed' => 'The New Password and Confirm Password does not match.'
		];
		$validator = Validator::make($request->all(),[
            'currentpass' => 'required',
			'newpass' => 'required|min:6|confirmed',
        ],$messages);
        if($validator->fails()){
            $this->throwValidationException($request,$validator);
        }
		$userData = Admin::find(Auth::guard('admin')->user()->id);
		if(!Hash::check($request->get('currentpass'),$userData->password)){
			$request->session()->flash('alert-danger','Please enter valid current password.');
			return redirect('admin/changepass');
		}
		$userData->password = Hash::make($request->get('newpass'));
		if($userData->save()){
			$request->session()->flash('alert-success','Password changes successfully.');
		}
		return redirect('admin/changepass');
    }
	
	public function profile() {
		$userData = Admin::find(Auth::guard('admin')->user()->id);
        return view('admin.profile',array('title' => 'Edit Profile','userData' => $userData));
    }
	
	public function postprofile(Request $request) {
		$validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
        if($validator->fails()){
            $this->throwValidationException($request,$validator);
        }
		$userData = Admin::find(Auth::guard('admin')->user()->id);
		$userData->name = $request->name;
		$userData->email = $request->email;
		if($userData->save()){
			$request->session()->flash('alert-success','Profile updated successfully.');
		}
		return redirect('admin/profile');
    }
}