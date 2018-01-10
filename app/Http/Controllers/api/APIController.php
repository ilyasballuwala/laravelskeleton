<?php

namespace App\Http\Controllers\api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Mail\ConfirmEmailRider;
use App\Mail\ConfirmEmailDriver;
use App\Mail\ForgotpasswordEmail;
use App\Riders;
use App\RiderImages;
use App\Drivers;
use App\DriverImages;
use App\DriverProfileHistory;
use App\DriverStatusLocation;
use App\DriverVehicles;
use App\VehicleImages;
use App\RidersFavouriteLocations;
use App\Jobs;
use App\JobDetails;
use App\JobLocations;
use App\JobPayments;
use App\SplashScreens;
use App\JobBids;
use App\JobRatings;
use App\CMS;
use Validator;
use Session;
use DB;
use File;
use Mail;
use Hash;
use URL;
use Auth;
use Config;

class APIController extends Controller
{
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         
    }

    /**
     * Default API action.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$allinput = $request->all();
		
        $returnarray = array();
		if(!isset($allinput['mode']) || $allinput['mode'] == "" || $allinput['mode'] == NULL){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Mode not found.';	
			return response()->json($returnarray);
			exit();
		}
		
		$actionmode = strtolower($allinput['mode']);
		//dd($actionmode);
		
		switch ($actionmode){
			case "riderregister":
				$returnarray = $this->riderRegister($allinput);
				break;
			case "riderlogin":
				$returnarray = $this->riderLogin($allinput);
				break;
			case "riderlogout":
				$returnarray = $this->riderLogout($allinput);
				break;
			case "riderforgotpassword":
				$returnarray = $this->riderForgotPassword($allinput);
				break;	
			case "ridereditprofile":
				$returnarray = $this->riderEditProfile($allinput);
				break;
			case "ridergetprofiledetail":
				$returnarray = $this->riderProfile($allinput);
				break;
			case "driverregister":
				$returnarray = $this->driverRegister($allinput);
				break;
			case "driverlogin":
				$returnarray = $this->driverLogin($allinput);
				break;
			case "driverlogout":
				$returnarray = $this->driverLogout($allinput);
				break;
			case "driverforgotpassword":
				$returnarray = $this->driverForgotPassword($allinput);
				break;	
			case "drivereditprofile":
				$returnarray = $this->driverEditProfile($allinput);
				break;
			case "drivereditlicencedetails":
				$returnarray = $this->driverEditLicenceDetails($allinput);
				break;	
			case "drivergetprofiledetail":
				$returnarray = $this->driverProfile($allinput);
				break;	
			case "addfavouritelocation":
				$returnarray = $this->addFavouriteLocation($allinput);
				break;
			case "listfavourite":
				$returnarray = $this->getFavouriteLocation($allinput);
				break;
			case "deletefavourite":
				$returnarray = $this->deleteFavouriteLocation($allinput);
				break;
			case "addnewjob":
				$returnarray = $this->addNewJob($allinput);
				break;
			case "jobbooked":
				$returnarray = $this->getMyBookedJobList($allinput);
				break;
			case "getmypendingjoblist":
				$returnarray = $this->getMyPendingJobList($allinput);
				break;	
			case "myjobdetail":
				$returnarray = $this->myJobDetail($allinput);
				break;
			case "cancelmyjob":
				$returnarray = $this->cancelMyJob($allinput);
				break;
			case "getjobhistory":
				$returnarray = $this->getJobHistory($allinput);
				break;
			case "changedriverstatuslocation":
				$returnarray = $this->changeDriverStatusLocation($allinput);
				break;
			case "getcmsinfo":
				$returnarray = $this->getCMSInfo($allinput);
				break;
			case "getsplashscreens":
				$returnarray = $this->getSplashScreens($allinput);
				break;
			case "getappliedbids":
				$returnarray = $this->getAppliedBids($allinput);
				break;
			case "getbiddetails":
				$returnarray = $this->getBidDetails($allinput);
				break;
			case "sendrequesttodriver":
				$returnarray = $this->sendRequestToDriver($allinput);
				break;
			case "givedriverrating":
				$returnarray = $this->giveDriverRating($allinput);
				break;
			case "getdrivercurrentvehicle":
				$returnarray = $this->getDriverCurrentVehicle($allinput);
				break;
			case "setdrivercurrentvehicle":
				$returnarray = $this->setDriverCurrentVehicle($allinput);
				break;
			case "getalldrivervehicle":
				$returnarray = $this->getAllDriverVehicle($allinput);
				break;
			case "addnewvehicle":
				$returnarray = $this->addNewVehicle($allinput);
				break;
			case "editvehicle":
				$returnarray = $this->editVehicle($allinput);
				break;
			case "getvehicledetails":
				$returnarray = $this->getVehicleDetails($allinput);
				break;	
			case "deletevehicle":
				$returnarray = $this->deleteVehicle($allinput);
				break;
			case "getpostedjobdetail":
				$returnarray = $this->getPostedJobDetail($allinput);
				break;
			case "submitbidforjob":
				$returnarray = $this->submitBidForJob($allinput);
				break;
			case "getallappliedbids":
				$returnarray = $this->getAllAppliedBids($allinput);
				break;
			case "submittedbidjobdetail":
				$returnarray = $this->submittedBidJobDetail($allinput);
				break;
			case "mybookingfordriver":
				$returnarray = $this->myBookingForDriver($allinput);
				break;
			case "processrequestedjob":
				$returnarray = $this->processRequestedJob($allinput);
				break;
			case "paymentregisterandriderrating":
				$returnarray = $this->paymentRegisterAndRiderRating($allinput);
				break;
			case "getdrivercurrentstatuslocation":
				$returnarray = $this->getDriverCurrentStatusLocation($allinput);
				break;
			case "awayfrompickuplocation":
				$returnarray = $this->awayFromPickupLocation($allinput);
				break;
			case "startjobtrip":
				$returnarray = $this->startJobTrip($allinput);
				break;
			case "completejobtrip":
				$returnarray = $this->completeJobTrip($allinput);
				break;	
			case "updatetriplocation":
				$returnarray = $this->updateTripLocation($allinput);
				break;
																	
			default:
				$returnarray['errormsg'] = 'Invalid Action';
		}
		
		return response()->json($returnarray);
		exit();
    }
	
	
	/***** General Common Functions *****/
	
	/**
     * Generate Random String.
     *
     * @return Given length Random String
     */
	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function getDistanceAndTime($lat1, $lat2, $long1, $long2)
	{
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response, true);
		//return $response_a;
		$dist = (isset($response_a['rows'][0]['elements'][0]['distance'])) ? $response_a['rows'][0]['elements'][0]['distance']['text'] : '0 km';
		$time = (isset($response_a['rows'][0]['elements'][0]['duration'])) ? $response_a['rows'][0]['elements'][0]['duration']['text'] : '0 min';
		$distvalue = (isset($response_a['rows'][0]['elements'][0]['distance'])) ? $response_a['rows'][0]['elements'][0]['distance']['value'] : 0;
		$timevalue = (isset($response_a['rows'][0]['elements'][0]['duration'])) ? $response_a['rows'][0]['elements'][0]['duration']['value'] : 0;
	
		return array('distance' => $dist, 'time' => $time, 'distancevalue' => $distvalue, 'timevalue' => $timevalue);
	}

	/**
     * Register Riders.
     *
     * @return Rider Registration Status with Registered ID
     */
    public function riderRegister($request){
		//dd($request);
		
		$validator = Validator::make($request, [           
			'name' => 'required',
			'email' => 'required|email|unique:riders',
			'password' => 'required|string|min:6',
			'phone' => 'required|unique:riders',
			'rider_avatar' => 'image',
        ]);
		
        if($validator->fails()) {
			//dd($validator);
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$dataArray = array();
		$dataArray['name'] = $request['name'];
		$dataArray['email'] = $request['email'];
		$dataArray['password'] = Hash::make($request['password']);
		$dataArray['phone'] = $request['phone'];
		$dataArray['business_customer'] = (isset($request['type']) && $request['type'] == "business") ? 1 : 0;
		$dataArray['rider_avg_rating'] = 0;
		if(isset($request['rider_avatar']) && $request['rider_avatar'] != "" && $request['rider_avatar'] != NULL){
			$imageName = 'rider_avatar.'.$request['rider_avatar']->getClientOriginalExtension();
			$dataArray['rider_avatar'] = trim($imageName);
		}
		$dataArray['email_verification_code'] = $this->generateRandomString(20);
		//$dataArray['rider_status'] = (isset($request['user_status']) && $request['user_status'] == "yes") ? 1 : 2;
		$dataArray['rider_status'] = 2;
		$dataArray['terms_condition_accept'] = (isset($request['terms']) && $request['terms'] == "no") ? 0 : 1;
		//dd($dataArray);
		
		$returnarray = array();
		if($user = Riders::create($dataArray))
		{
			if(isset($request['rider_avatar']) && $request['rider_avatar'] != "" && $request['rider_avatar'] != NULL){
				$path = public_path().'/images/riders/'.$user->id;
				File::makeDirectory($path, $mode = 0777, true, true);
				$request['rider_avatar']->move($path, $imageName);
			}
			
			$finalriderdetailsarray = array();
			$finalriderdetailsarray['name'] = $dataArray['name'];
			$finalriderdetailsarray['verificationurl'] = URL::to('api/v1/verifyrider/'.$user->id.'/'.$dataArray['email_verification_code']);
			
			Mail::to($dataArray['email'])->send(new ConfirmEmailRider($finalriderdetailsarray));
			if (Mail::failures()) {
				$returnarray['email_send'] = 0;
			}
			else{
				$returnarray['email_send'] = 1;
			}
			$returnarray['status'] = 1;
			$returnarray['msg'] = 'success';
			$returnarray['riderid'] = $user->id;
		}
		else{
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'There are some problem occured in register user.';
		}
		
		return $returnarray;
    }
	
	/**
     * Login Riders
     *
     * @return \Illuminate\Http\Response
     */
    public function riderLogin($request){
		//dd($request);
		
		$validator = Validator::make($request, [           
			'email' => 'required|email',
			'password' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$returnarray = array();
		$returnarray['msg'] = '';
		$returnarray['errormsg'] = '';
		
		if(!Auth::check()){	
			if(Auth::attempt(['email'=>$request['email'], 'password'=>$request['password'] , 'rider_status'=>1])){
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'success';
				$returnarray['riderid'] = Auth::id();
			}
			else{
				$returnarray['status'] = 0;
				$userexist = Riders::where('email',$request['email'])->first();
				if(count($userexist) > 0 && $userexist->email_verification_status == '0'){
					$returnarray['errormsg'] = 'Verification link has been sent to your registered email address. Please verify your email address.';
				}
				else{
					$returnarray['errormsg'] = 'Invalid Credentials';
				}
			}
		}
		else{
			$returnarray['status'] = 1;
			$returnarray['msg'] = 'Already Logged In';
			$returnarray['riderid'] = Auth::id();
		}
		return $returnarray;
    }
	
	/**
     * Logout Riders
     *
     * @return \Illuminate\Http\Response
     */
	public function riderLogout($request){
		$validator = Validator::make($request, [           
			'riderid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$riderid = $request['riderid'];
		$logoutstatus = Auth::logout();
		Session::flush();
		$returnarray = array();
		$returnarray['status'] = 1;
		$returnarray['msg'] = 'Logged out';
		$returnarray['riderid'] = $request['riderid'];
		return $returnarray;
	}
	
	/**
     * Riders Forgot Password.
     *
     * @return \Illuminate\Http\Response
     */
    public function riderForgotPassword($request){
		//dd($request); 	
		$validator = Validator::make($request, [           
			'email' => 'required|email',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$userdata = Riders::where('email',$request['email'])->first();
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'No user is registered with the given email address. Invalid Rider';
		}
		else{
			$newpassword = $this->generateRandomString(10);
			$userdata->password = Hash::make(trim($newpassword));
			
			if($userdata->update())
			{
				$finalriderdetailsarray = array();
				$finalriderdetailsarray['name'] = $userdata->name;
				$finalriderdetailsarray['newpassword'] = $newpassword;
				//$finalriderdetailsarray['verificationurl'] = URL::to('api/v1/forgotpassworduser/'.$request['riderid'].'/'.$dataArray['verification_code']);
				
				Mail::to($userdata->email)->send(new ForgotpasswordEmail($finalriderdetailsarray));
				if (Mail::failures()) {
					$returnarray['email_send'] = 0;
				}
				else{
					$returnarray['email_send'] = 1;
				}
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'We have send new generated passwrord to your registered email address. Please check your mail account.';
				$returnarray['riderid'] = $userdata->id;
			}
			else{
				$returnarray['errormsg'] = 'There are some problem occured in generate new password to user.';
				$returnarray['status'] = 0;
			}	
		}
		
		return $returnarray;
    }
	
	/**
     * Get Riders Profile Details.
     *
     * @return Rider All Details
     */
    public function riderProfile($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'riderid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$userdata = Riders::with('Riderimages')->find($request['riderid']);
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Registration ID not exist. Invalid Rider';
		}
		else{
			$returnarray['status'] = 1;
			$returnarray['msg'] = 'success';
			$finaluserdata = array();
			$finaluserdata['riderid'] = $userdata->id;
			$finaluserdata['name'] = $userdata->name;
			$finaluserdata['email'] = $userdata->email;
			$finaluserdata['phone'] = $userdata->phone;
			$finaluserdata['avatarimage'] = (!empty($userdata->Riderimages) && count($userdata->Riderimages) > 0 && $userdata->Riderimages->avatar_image != NULL)?  $userdata->Riderimages->avatar_image : NULL;
			/*if($userdata->rider_avatar != "" && $userdata->rider_avatar != NULL){
				$finaluserdata['avatarpath'] = URL::asset('images/riders').'/'.$userdata->id.'/'.$userdata->rider_avatar;
			}
			else{
				$finaluserdata['avatarpath'] = '';
			}*/
			$returnarray['userdata'] = $finaluserdata;
		}
		
		return $returnarray;
    }
	
	/**  
     * Verify user process.
     *
     * @return verification status
     */
	public function verifyrider($userid, $verificationcode) {
		$userdata = Riders::where('id','=',$userid)->where('email_verification_code','=',$verificationcode)->first();
		$username = '';
		if(empty($userdata) || count($userdata) == 0 || $userdata == NULL){
			$username = 'User';
			$verificationstatus = "Invalid Rider OR Verification Code";
		}
		else{
			//dd($userdata);
			$username = ucfirst($userdata->name);
			if($userdata->email_verification_status == '1'){
				$verificationstatus = "You have already verified your email address.";
			}
			else{
				$userdata->email_verification_status = '1';
				$userdata->rider_status = '1';
				/*if(($userdata->user_type == 1) || ($userdata->user_type == 2 && $userdata->user_status == 5)){
					$userdata->user_status = 1;
				}*/
				if($userdata->update()){
					$verificationstatus = "You have sucessfully verified your email address. You can login in the app with your login details. Happy Riding.";
				}
				else{
					$verificationstatus = "There are some problem occured to verify. Please try after some time";
				}
			}
		}
		return view('user.userverification')->with(compact('verificationstatus','username'));
	}
	
	/**
     * Edit Riders Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function riderEditProfile($request){
		//dd($request);
		
		$request['phone'] = (isset($request['phone']) && $request['phone'] != "" && $request['phone'] != NULL) ? trim($request['phone']) : ''; 
			
		$validator = Validator::make($request, [           
			'riderid' => 'required',
			'phone' => 'unique:riders,phone,'.$request['riderid'].',id',
        ]);
		
        if($validator->fails()) {
			//dd($validator);
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$userdata = Riders::find($request['riderid']);
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Rider ID not exist. Invalid Rider';
		}
		else{
			$userpreviousemail = $userdata->email;
			if(isset($request['name']) && $request['name'] != "" && $request['name'] != NULL){
				$userdata->name = $request['name'];
			}
			if(isset($request['phone']) && $request['phone'] != "" && $request['phone'] != NULL){
				$userdata->phone = $request['phone'];
			}
			if(isset($request['rider_avatar']) && $request['rider_avatar'] != "" && $request['rider_avatar'] != NULL){
				$imageName = 'rider_avatar.jpg';
				$userdata->rider_avatar = trim($imageName);
			}
			//dd($userdata);
			if($userdata->update())
			{
				if(isset($request['rider_avatar']) && $request['rider_avatar'] != "" && $request['rider_avatar'] != NULL){
					
					$driverimagedata = RiderImages::firstOrNew(array('rider_id' => $request['riderid']));
					$driverimagedata->avatar_image = $request['rider_avatar'];
					$driverimagedata->save();
					
					/*$path = public_path().'/images/riders/'.$request['riderid'];
					File::makeDirectory($path, $mode = 0777, true, true);
					$imagepathpath = $path.'/'.$imageName;
					$img = $request['rider_avatar'];
					$img = substr($img, strpos($img, ",")+1);
					$data = base64_decode($img);
					$success = file_put_contents($imagepathpath, $data);*/
					$returnarray['avatarimage'] = $request['rider_avatar'];
				}
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'success';
				//$returnarray['avatarpath'] = URL::asset('images/riders/'.$request['riderid'].'/'.$userdata->rider_avatar);
				$returnarray['riderid'] = $request['riderid'];
			}
			else{
				$returnarray['status'] = 0;
				$returnarray['errormsg'] = 'There are some problem occured in edit user profile.';
			}	
		}
		return $returnarray;
    }
	
	/**
     * Register Drivers.
     *
     * @return \Illuminate\Http\Response
     */
    public function driverRegister($request){
		//dd($request);
		
		$validator = Validator::make($request, [           
			'name' => 'required',
			'email' => 'required|email|unique:drivers',
			'password' => 'required|string|min:6',
			'phone' => 'required|unique:drivers',
			//'driver_avatar' => 'required|image',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$dataArray = array();
		$dataArray['name'] = $request['name'];
		$dataArray['email'] = $request['email'];
		$dataArray['password'] = Hash::make($request['password']);
		$dataArray['phone'] = $request['phone'];
		$dataArray['driver_avg_rating'] = 0;
		/*$imageName = 'driver_avatar.'.$request['driver_avatar']->getClientOriginalExtension();
		$dataArray['driver_avatar'] = trim($imageName);*/
		$dataArray['email_verification_code'] = $this->generateRandomString(20);
		$dataArray['driver_status'] = 2;
		$dataArray['terms_condition_accept'] = (isset($request['terms']) && $request['terms'] == "no") ? 0 : 1;
		//dd($dataArray);
		
		$returnarray = array();
		if($user = Drivers::create($dataArray))
		{
			/*$path = public_path().'/images/drivers/'.$user->id;
			File::makeDirectory($path, $mode = 0777, true, true);
			$request['driver_avatar']->move($path, $imageName);*/
			
			$tempprofiledata = array();
			$tempprofiledata['driver_id'] = $user->id;
			$tempprofiledata['name'] = $request['name'];
			$tempprofiledata['email'] = $request['email'];
			$tempprofiledata['phone'] = $request['phone'];
			DriverProfileHistory::create($tempprofiledata);
			
			$finalriderdetailsarray = array();
			$finalriderdetailsarray['name'] = $dataArray['name'];
			$finalriderdetailsarray['verificationurl'] = URL::to('api/v1/verifydriver/'.$user->id.'/'.$dataArray['email_verification_code']);
			
			Mail::to($dataArray['email'])->send(new ConfirmEmailDriver($finalriderdetailsarray));
			if (Mail::failures()) {
				$returnarray['email_send'] = 0;
			}
			else{
				$returnarray['email_send'] = 1;
			}
			$returnarray['status'] = 1;
			$returnarray['msg'] = 'success';
			$returnarray['driverid'] = $user->id;
		}
		else{
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'There are some problem occured in register user.';
		}
		
		return $returnarray;
    }
	
	/**
     * Login Driver
     *
     * @return \Illuminate\Http\Response
     */
    public function driverLogin($request){
		//dd($request);
		
		$validator = Validator::make($request, [           
			'email' => 'required|email',
			'password' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$returnarray = array();
		$returnarray['msg'] = '';
		$returnarray['errormsg'] = '';
		
		if(!Auth::guard('drivers')->check()){	
			if(Auth::guard('drivers')->attempt(['email'=>$request['email'], 'password'=>$request['password'], 'driver_status'=> 1 ])){
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'success';
				$returnarray['driverid'] = Auth::guard('drivers')->id();
			}
			else{
				$returnarray['status'] = 0;
				$userexist = Drivers::where('email',$request['email'])->first();
				if(count($userexist) > 0 && $userexist->email_verification_status == '0'){
					$returnarray['errormsg'] = 'Verification link has been sent to your registered email address. Please verify your email address.';
				}
				else{
					$returnarray['errormsg'] = 'Invalid Credentials';
				}
			}
		}
		else{
			$returnarray['status'] = 1;
			$returnarray['msg'] = 'Already Logged In';
			$returnarray['driverid'] = Auth::guard('drivers')->id();
		}
		return $returnarray;
    }
	
	/**
     * Logout Driver
     *
     * @return \Illuminate\Http\Response
     */
	public function driverLogout($request){
		$validator = Validator::make($request, [           
			'driverid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		$driverid = $request['driverid'];
		$logoutstatus = Auth::guard('drivers')->logout();
		Session::flush();
		$returnarray = array();
		$returnarray['status'] = 1;
		$returnarray['msg'] = 'Logged out';
		return $returnarray;
	}
	
	/**
     * Driver Forgot Password.
     *
     * @return \Illuminate\Http\Response
     */
    public function driverForgotPassword($request){
		//dd($request); 	
		$validator = Validator::make($request, [           
			'email' => 'required|email',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$userdata = Drivers::where('email',$request['email'])->first();
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'No user is registered with the given email address. Invalid Driver';
		}
		else{
			$newpassword = $this->generateRandomString(10);
			$userdata->password = Hash::make(trim($newpassword));
			
			if($userdata->update())
			{
				$finalriderdetailsarray = array();
				$finalriderdetailsarray['name'] = $userdata->name;
				$finalriderdetailsarray['newpassword'] = $newpassword;
				//$finalriderdetailsarray['verificationurl'] = URL::to('api/v1/forgotpassworduser/'.$request['riderid'].'/'.$dataArray['verification_code']);
				
				Mail::to($userdata->email)->send(new ForgotpasswordEmail($finalriderdetailsarray));
				if (Mail::failures()) {
					$returnarray['email_send'] = 0;
				}
				else{
					$returnarray['email_send'] = 1;
				}
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'success';
				$returnarray['driverid'] = $userdata->id;
			}
			else{
				$returnarray['errormsg'] = 'There are some problem occured in send new password to user.';
				$returnarray['status'] = 0;
			}	
		}
		return $returnarray;
    }
	
	/**
     * Get Driver Profile Details.
     *
     * @return \Illuminate\Http\Response
     */
    public function driverProfile($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$userdata = Drivers::with('Driverimages')->find($request['driverid']);
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Driver ID not exist. Invalid Driver';
		}
		else{
			$returnarray['status'] = 1;
			$returnarray['msg'] = 'success';
			$finaluserdata = array();
			$finaluserdata['driverid'] = $userdata->id;
			$finaluserdata['name'] = $userdata->name;
			$finaluserdata['email'] = $userdata->email;
			$finaluserdata['phone'] = $userdata->phone;
			$finaluserdata['address'] = $userdata->driver_address;
			$finaluserdata['driver_licence_no'] = $userdata->driver_licence_no;
			$finaluserdata['licence_expire_date'] = $userdata->licence_expire_date;
			$finaluserdata['driver_per_mile_rate'] = $userdata->driver_per_mile_rate;
			/*if($userdata->driver_avatar != "" && $userdata->driver_avatar != NULL){
				$finaluserdata['avatarpath'] = public_path().'/images/drivers/'.$userdata->id.'/'.$userdata->driver_avatar;
			}*/
			$finaluserdata['avatarimage'] = (!empty($userdata->Driverimages) && count($userdata->Driverimages) > 0 && $userdata->Driverimages->avatar_image != NULL) ? $userdata->Driverimages->avatar_image : NULL;
			$finaluserdata['licenceimage'] = (!empty($userdata->Driverimages) && count($userdata->Driverimages) > 0 && $userdata->Driverimages->licence_image != NULL) ? $userdata->Driverimages->licence_image : NULL;
			$returnarray['userdata'] = $finaluserdata;
		}
		
		return $returnarray;
    }
	
	/**  
     * Verify driver email process.
     *
     * @return verification status
     */
	public function verifydriver($userid, $verificationcode) {
		$userdata = Drivers::where('id','=',$userid)->where('email_verification_code','=',$verificationcode)->first();
		$username = '';
		if(empty($userdata) || count($userdata) == 0 || $userdata == NULL){
			$username = 'User';
			$verificationstatus = "Invalid Driver OR Verification Code";
		}
		else{
			//dd($userdata);
			$username = ucfirst($userdata->name);
			if($userdata->email_verification_status == '1'){
				$verificationstatus = "You have already verified your email address.";
			}
			else{
				$userdata->email_verification_status = '1';
				$userdata->driver_status = '1';
				if($userdata->update()){
					$verificationstatus = "You have sucessfully verified your email address. You can login in the app with your login details. Happy Riding.";
				}
				else{
					$verificationstatus = "There are some problem occured to verify. Please try after some time";
				}
			}
		}
		return view('user.userverification')->with(compact('verificationstatus','username'));
	}
	
	/**
     * Edit Driver Profile.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function driverEditProfile($request){
		//dd($request);
		
		$request['email'] = (isset($request['email']) && $request['email'] != "" && $request['email'] != NULL) ? trim($request['email']) : '';
		$request['phone'] = (isset($request['phone']) && $request['phone'] != "" && $request['phone'] != NULL) ? trim($request['phone']) : ''; 
			
		$validator = Validator::make($request, [           
			'driverid' => 'required',
			'email' => 'email|unique:drivers,email,'.$request['driverid'].',id',
			'phone' => 'unique:drivers,phone,'.$request['driverid'].',id',
			'driver_avatar' => 'image',
        ]);
		
        if($validator->fails()) {
			//dd($validator);
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$userdata = Drivers::find($request['driverid']);
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Driver ID not exist. Invalid Driver';
		}
		else{
			$drivertempdata = DriverProfileHistory::where('driver_id',$request['driverid'])->orderBy('updated_at', 'desc')->first();			
			$needapproval = 0;
			
			if(empty($drivertempdata) || count($drivertempdata) == 0 || $drivertempdata->details_approved == 1){
				$licencedata = array();
				$licencedata['driver_id'] = $request['driverid'];
				if(isset($request['name']) && $request['name'] != "" && $request['name'] != NULL){
					$needapproval = 1;
					$licencedata['name'] = $request['name'];
				}
				if(isset($request['email']) && $request['email'] != "" && $request['email'] != NULL){
					$licencedata['email'] = $request['email'];
					$needapproval = 1;
				}
				if(isset($request['phone']) && $request['phone'] != "" && $request['phone'] != NULL){
					$licencedata['phone'] = $request['phone'];
					$needapproval = 1;
				}
				if(isset($request['address']) && $request['address'] != "" && $request['address'] != NULL){
					$licencedata['driver_address'] = $request['address'];
					$needapproval = 1;
				}
				if(isset($request['driver_avatar']) && $request['driver_avatar'] != "" && $request['driver_avatar'] != NULL){
					$imageName = 'driver_avatar.'.$request['driver_avatar']->getClientOriginalExtension();
					$licencedata['driver_avatar'] = trim($imageName);
					$needapproval = 1;
				}
				
				if(DriverProfileHistory::create($licencedata))
				{
					if(isset($request['driver_avatar']) && $request['driver_avatar'] != "" && $request['driver_avatar'] != NULL){
						$path = public_path().'/images/drivers/'.$request['driverid'].'/update_request';
						File::makeDirectory($path, $mode = 0777, true, true);
						if($request['driver_avatar']->move($path, $imageName)){
							$returnarray['driver_image_upload'] = 1;
						}
						else{
							$returnarray['driver_image_upload'] = 0;
						}
					}
							
					$returnarray['status'] = 1;
					$returnarray['msg'] = 'success';
					$driveravatarpath = ($userdata->driver_avatar != "" && $userdata->driver_avatar != NULL) ? URL::asset('images/drivers/'.$request['driverid'].'/'.$userdata->driver_avatar) : '';
					$returnarray['avatarpath'] = $driveravatarpath;
					$returnarray['driverid'] = $request['driverid'];
				}
				else{
					$returnarray['status'] = 0;
					$returnarray['errormsg'] = 'There are some problem occured in edit driver licence details.';
				}
			}
			else{
				if(isset($request['name']) && $request['name'] != "" && $request['name'] != NULL){
					$needapproval = 1;
					$drivertempdata->name = $request['name'];
				}
				if(isset($request['email']) && $request['email'] != "" && $request['email'] != NULL){
					$drivertempdata->email = $request['email'];
					$needapproval = 1;
				}
				if(isset($request['phone']) && $request['phone'] != "" && $request['phone'] != NULL){
					$drivertempdata->phone = $request['phone'];
					$needapproval = 1;
				}
				if(isset($request['driver_address']) && $request['driver_address'] != "" && $request['driver_address'] != NULL){
					$drivertempdata->driver_address = $request['driver_address'];
					$needapproval = 1;
				}
				if(isset($request['driver_avatar']) && $request['driver_avatar'] != "" && $request['driver_avatar'] != NULL){
					$imageName = 'driver_avatar.'.$request['driver_avatar']->getClientOriginalExtension();
					$drivertempdata->driver_avatar = trim($imageName);
					$needapproval = 1;
				}
				//dd($drivertempdata);	
				if($drivertempdata->update())
				{
					if(isset($request['driver_avatar']) && $request['driver_avatar'] != "" && $request['driver_avatar'] != NULL){
						$path = public_path().'/images/drivers/'.$request['driverid'].'/update_request';
						File::makeDirectory($path, $mode = 0777, true, true);
						if($request['driver_avatar']->move($path, $imageName)){
							$returnarray['driver_image_upload'] = 1;
						}
						else{
							$returnarray['driver_image_upload'] = 0;
						}
					}
					
					$returnarray['status'] = 1;
					$returnarray['msg'] = 'success';
					$driveravatarpath = ($userdata->driver_avatar != "" && $userdata->driver_avatar != NULL) ? URL::asset('images/drivers/'.$request['driverid'].'/'.$userdata->driver_avatar) : '';
					$returnarray['avatarpath'] = $driveravatarpath;
					$returnarray['driverid'] = $request['driverid'];
				}
				else{
					$returnarray['status'] = 0;
					$returnarray['errormsg'] = 'There are some problem occured in edit user profile.';
				}
			}
			
			if(isset($request['driver_per_mile_rate']) && $request['driver_per_mile_rate'] != "" && $request['driver_per_mile_rate'] != NULL){
				$userdata->driver_per_mile_rate = $request['driver_per_mile_rate'];
			}
			if(isset($request['password']) && $request['password'] != "" && $request['password'] != NULL){
				//$userdata->password = Hash::make($request['password']);
			}
			if($needapproval == 1){ $userdata->profile_details_verification = '0'; }	
			$userdata->update();
		}
		return $returnarray;
    }*/
	
	public function driverEditProfile($request){
		//dd($request);
		
		$request['phone'] = (isset($request['phone']) && $request['phone'] != "" && $request['phone'] != NULL) ? trim($request['phone']) : ''; 
			
		$validator = Validator::make($request, [           
			'driverid' => 'required',
			'phone' => 'unique:drivers,phone,'.$request['driverid'].',id',
        ]);
		
        if($validator->fails()) {
			//dd($validator);
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$userdata = Drivers::find($request['driverid']);
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Driver ID not exist. Invalid Driver';
		}
		else{			
			if(isset($request['name']) && $request['name'] != "" && $request['name'] != NULL){
				$userdata->name = $request['name'];
			}
			if(isset($request['phone']) && $request['phone'] != "" && $request['phone'] != NULL){
				$userdata->phone = $request['phone'];
			}
			if(isset($request['address']) && $request['address'] != "" && $request['address'] != NULL){
				$userdata->driver_address = $request['address'];
			}
			if(isset($request['driver_avatar']) && $request['driver_avatar'] != "" && $request['driver_avatar'] != NULL){
				$imageName = 'driver_avatar.jpg';
				$userdata->driver_avatar = trim($imageName);
			}
			if(isset($request['per_mile_rate']) && $request['per_mile_rate'] != "" && $request['per_mile_rate'] != NULL){
				$userdata->driver_per_mile_rate = $request['per_mile_rate'];
			}
			if($userdata->update())
			{
				//return $returnarray['driveravatar'] = $request['driver_avatar'];
				if(isset($request['driver_avatar']) && $request['driver_avatar'] != "" && $request['driver_avatar'] != NULL){
					
					$driverimagedata = DriverImages::firstOrNew(array('driver_id' => $request['driverid']));
					$driverimagedata->avatar_image = $request['driver_avatar'];
					$driverimagedata->save();

					/*$path = public_path().'/images/drivers/'.$request['driverid'];
					File::makeDirectory($path, $mode = 0777, true, true);
					$imagepathpath = $path.'/'.$imageName;
					$img = $request['driver_avatar'];
					$img = substr($img, strpos($img, ",")+1);
					$data = base64_decode($img);
					$success = file_put_contents($imagepathpath, $data);*/ 
					$returnarray['avatarimage'] = $request['driver_avatar'];
				}
						
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'success';
				$returnarray['driverid'] = $request['driverid'];
				$driveravatarpath = ($userdata->driver_avatar != "" && $userdata->driver_avatar != NULL) ? URL::asset('images/drivers/'.$request['driverid'].'/'.$userdata->driver_avatar) : '';
				//$returnarray['avatarpath'] = $driveravatarpath;
				
				
			}
			else{
				$returnarray['status'] = 0;
				$returnarray['errormsg'] = 'There are some problem occured in edit driver licence details.';
			}
		}	
		return $returnarray;
    }
	
	/**
     * Edit Driver Licence Details.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function driverEditLicenceDetails($request){
		//dd($request);
		
		$request['driverid'] = (isset($request['driverid']) && $request['driverid'] != "" && $request['driverid'] != NULL) ? trim($request['driverid']) : ''; 
		
		$userdata = Drivers::find($request['driverid']);
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Driver ID not exist. Invalid Driver';
		}
		else{
			if($userdata->licence_details_verification == 2){
				$validator = Validator::make($request, [           
					'driverid' => 'required',
					'driver_licence_no' => 'required|unique:drivers,driver_licence_no,'.$request['driverid'].',id',
					'licence_expire_date' => 'required',
					'driver_licence_image' => 'required|image',
				]);
			}
			else{
				$validator = Validator::make($request, [           
					'driverid' => 'required',
					'driver_licence_no' => 'unique:drivers,driver_licence_no,'.$request['driverid'].',id',
					'driver_licence_image' => 'image',
				]);
			}
				if($validator->fails()) {
					//dd($validator);
					return response()->json([
						'status' => 0,
						'errormsg' => $validator->errors()
					]);
				}
			
			$drivertempdata = DriverProfileHistory::where('driver_id',$request['driverid'])->orderBy('updated_at', 'desc')->first();
			$needapproval = 0;
			
			if(empty($drivertempdata) || count($drivertempdata) == 0 || $drivertempdata->details_approved == 1){
				$licencedata = array();
				$licencedata['driver_id'] = $request['driverid'];
				if(isset($request['driver_licence_no']) && $request['driver_licence_no'] != "" && $request['driver_licence_no'] != NULL){
					$licencedata['driver_licence_no'] = $request['driver_licence_no'];
					$needapproval = 1;
				}
				if(isset($request['licence_expire_date']) && $request['licence_expire_date'] != "" && $request['licence_expire_date'] != NULL){
					$licencedata['licence_expire_date'] = $request['licence_expire_date'];
					$needapproval = 1;
				}
				if(isset($request['driver_licence_image']) && $request['driver_licence_image'] != "" && $request['driver_licence_image'] != NULL){
					$licenceImageName = 'driver_licence_image.'.$request['driver_licence_image']->getClientOriginalExtension();
					$licencedata['driver_licence_image'] = trim($licenceImageName);
					$needapproval = 1;
				}
				if(DriverProfileHistory::create($licencedata))
				{
					if(isset($request['driver_licence_image']) && $request['driver_licence_image'] != "" && $request['driver_licence_image'] != NULL){	
						$path = public_path().'/images/drivers/'.$request['driverid'].'/update_request';
						File::makeDirectory($path, $mode = 0777, true, true);
						if($request['driver_licence_image']->move($path, $licenceImageName)){
							$returnarray['licence_image_upload'] = 1;
						}
						else{
							$returnarray['licence_image_upload'] = 0;
						}
					}
					
					$returnarray['status'] = 1;
					$returnarray['msg'] = 'Success. Your updated details will be reflected once it will be approved by the super admin.';
					$driverlicenceimagepath = ($userdata->driver_licence_image != "" && $userdata->driver_licence_image != NULL) ? URL::asset('images/drivers/'.$request['driverid'].'/'.$userdata->driver_licence_image) : '';
					$returnarray['licenceimagepath'] = $driverlicenceimagepath;
					$returnarray['driverid'] = $request['driverid'];
				}
				else{
					$returnarray['status'] = 0;
					$returnarray['errormsg'] = 'There are some problem occured in edit driver licence details.';
				}
			}
			else{
				if(isset($request['driver_licence_no']) && $request['driver_licence_no'] != "" && $request['driver_licence_no'] != NULL){
					$drivertempdata->driver_licence_no = $request['driver_licence_no'];
					$needapproval = 1;
				}
				if(isset($request['licence_expire_date']) && $request['licence_expire_date'] != "" && $request['licence_expire_date'] != NULL){
					$drivertempdata->licence_expire_date = $request['licence_expire_date'];
					$needapproval = 1;
				}
				if(isset($request['driver_licence_image']) && $request['driver_licence_image'] != "" && $request['driver_licence_image'] != NULL){
					$licenceImageName = 'driver_licence_image.'.$request['driver_licence_image']->getClientOriginalExtension();
					$drivertempdata->driver_licence_image = trim($licenceImageName);
					$needapproval = 1;
				}
				//dd($drivertempdata);	
				if($drivertempdata->update())
				{	
					if(isset($request['driver_licence_image']) && $request['driver_licence_image'] != "" && $request['driver_licence_image'] != NULL){
						$path = public_path().'/images/drivers/'.$request['driverid'].'/update_request';
						File::makeDirectory($path, $mode = 0777, true, true);
						if($request['driver_licence_image']->move($path, $licenceImageName)){
							$returnarray['licence_image_upload'] = 1;
						}
						else{
							$returnarray['licence_image_upload'] = 0;
						}
					}
					$returnarray['status'] = 1;
					$returnarray['msg'] = 'Success. Your updated details will be reflected once it will be approved by the admin.';
					$driverlicenceimagepath = ($userdata->driver_licence_image != "" && $userdata->driver_licence_image != NULL) ? URL::asset('images/drivers/'.$request['driverid'].'/'.$userdata->driver_licence_image) : '';
					$returnarray['licenceimagepath'] = $driverlicenceimagepath;
					$returnarray['driverid'] = $request['driverid'];
				}
				else{
					$returnarray['status'] = 0;
					$returnarray['errormsg'] = 'There are some problem occured in edit user profile.';
				}
			}
			if($needapproval = 1){ $userdata->licence_details_verification = '0'; };
			$userdata->update();
		}
		return $returnarray;
    }*/
	public function driverEditLicenceDetails($request){
		//dd($request);
		
		$request['driverid'] = (isset($request['driverid']) && $request['driverid'] != "" && $request['driverid'] != NULL) ? trim($request['driverid']) : ''; 
		
		$userdata = Drivers::find($request['driverid']);
		$returnarray = array();
		if(empty($userdata) || count($userdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Driver ID not exist. Invalid Driver';
		}
		else{
			$validator = Validator::make($request, [           
				'driverid' => 'required',
				'driver_licence_no' => 'required|unique:drivers,driver_licence_no,'.$request['driverid'].',id',
				'licence_expire_date' => 'required',
				//'driver_licence_image' => 'required|image',
			]);
			if($validator->fails()) {
				//dd($validator);
				return response()->json([
					'status' => 0,
					'errormsg' => $validator->errors()
				]);
			}
			
			if(isset($request['driver_licence_no']) && $request['driver_licence_no'] != "" && $request['driver_licence_no'] != NULL){
				$userdata->driver_licence_no = $request['driver_licence_no'];
			}
			if(isset($request['licence_expire_date']) && $request['licence_expire_date'] != "" && $request['licence_expire_date'] != NULL){
				$userdata->licence_expire_date = $request['licence_expire_date'];
			}
			if(isset($request['driver_licence_image']) && $request['driver_licence_image'] != "" && $request['driver_licence_image'] != NULL){
				$licenceImageName = 'driver_licence_image.jpg';
				$userdata->driver_licence_image = trim($licenceImageName);
			}
			if($userdata->update())
			{
				if(isset($request['driver_licence_image']) && $request['driver_licence_image'] != "" && $request['driver_licence_image'] != NULL){
					$driverimagedata = DriverImages::firstOrNew(array('driver_id' => $request['driverid']));
					$driverimagedata->licence_image = $request['driver_licence_image'];
					$driverimagedata->save();
						
					/*$path = public_path().'/images/drivers/'.$request['driverid'];
					File::makeDirectory($path, $mode = 0777, true, true);
					$imagepathpath = $path.'/'.$licenceImageName;
					$img = $request['driver_licence_image'];
					$img = substr($img, strpos($img, ",")+1);
					$data = base64_decode($img);
					$success = file_put_contents($imagepathpath, $data);*/	
					$returnarray['licenceimage'] = $request['driver_licence_image'];
				}
				
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'success';
				$returnarray['driverid'] = $request['driverid'];
				//$driverlicenceimagepath = ($userdata->driver_licence_image != "" && $userdata->driver_licence_image != NULL) ? URL::asset('images/drivers/'.$request['driverid'].'/'.$userdata->driver_licence_image) : '';
				//$returnarray['licenceimagepath'] = $driverlicenceimagepath;
			}
			else{
				$returnarray['status'] = 0;
				$returnarray['errormsg'] = 'There are some problem occured in edit driver licence details.';
			}
		}
		return $returnarray;
    }
	
	/**
     * Add Favourite Location.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFavouriteLocation($request){
		
		$validator = Validator::make($request, [           
			'riderid' => 'required',
			'location_nickname' => 'required|unique:rider_favorite_locations,location_nickname,NULL,id,rider_id,'.$request['riderid'],
			'location_address' => 'required|unique:rider_favorite_locations,location_address,NULL,id,rider_id,'.$request['riderid'],
			'location_lat' => 'required',
			'location_long' => 'required',
        ],[
			'location_nickname.unique' => 'The location name has already been taken by you.',
			'location_address.unique' => 'The location address has already been registered by you.',
		]);
		
		
        if($validator->fails()) {
			//dd($validator);
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$riderdata = Riders::find($request['riderid']);
		if(empty($riderdata) || count($riderdata) == 0){
			$returnarray['status'] = 0;
			$returnarray['errormsg'] = 'Invalid Rider';
		}
		else{
			$dataArray = array();
			$dataArray['location_address'] = $request['location_address'];
			$dataArray['location_nickname'] = $request['location_nickname'];
			$dataArray['location_latitude'] = $request['location_lat'];
			$dataArray['location_longitude'] = $request['location_long'];
			$dataArray['rider_id'] = $request['riderid'];
			
			$returnarray = array();
	
			if($favouritelocation = RidersFavouriteLocations::create($dataArray))
			{
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'success';
				$returnarray['favouriteid'] = $favouritelocation->id;
			}
			else{
				$returnarray['status'] = 0;
				$returnarray['errormsg'] = 'There are some problem occured in save favourite location.';
			}
		}
		return $returnarray;
    }
	
	/**
     * Get Riders Favourite Locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFavouriteLocation($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'riderid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$locationdata = RidersFavouriteLocations::where('rider_id','=',$request['riderid'])->get();
		$returnarray = array();
		if(empty($locationdata) || count($locationdata) == 0){
			$returnarray['errormsg'] = 'No favourite found for this user';
			$returnarray['status'] = 0;
		}
		else{
			$returnarray['status'] = 1;
			$returnarray['msg'] = 'Favourite list fetched successfully';
			
			$finallocationdata = array();
			foreach($locationdata as $location){
				$templocationdata = array();
				$templocationdata['FavouriteId'] = $location['id'];
				$templocationdata['NickName'] = $location['location_nickname'];
				$templocationdata['Address'] = $location['location_address'];
				$templocationdata['Lat'] = $location['location_latitude'];
				$templocationdata['Long'] = $location['location_longitude'];
				array_push($finallocationdata,$templocationdata);
			}
			$returnarray['FavouriteLocationList'] = $finallocationdata;			
		}
		return $returnarray;
    }
	
	/**
     * Delete Riders Favourite Locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteFavouriteLocation($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'favouriteid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		if(RidersFavouriteLocations::destroy($request['favouriteid'])){
			$returnarray['msg'] = 'Favourite deleted successfully';
			$returnarray['status'] = 1;
		}
		else{
			$returnarray['errormsg'] = 'Some problem occured to delete the favourite.';
			$returnarray['status'] = 0;
		}
		return $returnarray;
    }
	
	/**
     * Sort Array.
     *
     * @return Sortable Array
     */
	public function array_sort($array, $on, $order=SORT_ASC){
		$new_array = array();
		$sortable_array = array();
	
		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}
	
			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
					break;
				case SORT_DESC:
					arsort($sortable_array);
					break;
			}
	
			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}
	
		return $new_array;
	}

	/**
     * Add New Job.
     *
     * @return Job Created Response
     */
    public function addNewJob($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'riderid' => 'required',
			'datetime' => 'required',
			'type' => 'required',
			'passanger' => 'required|numeric',
			'largeluggage' => 'numeric',
			'smallluggage' => 'numeric',
			'wheelchairpassanger' => 'numeric',
			'child' => 'numeric',
			'childbooster' => 'numeric',
			'Source' => 'required',
			'Destination' => 'required',
        ]);
		
        if($validator->fails()) {
			return [ 
				'status' => 0,
				'errormsg' => $validator->errors()
			];	
		}
		
		$jobdata = array();
		$jobdata['rider_id'] = $request['riderid'];
		$jobdata['job_id'] = 'CRY'.date('YmdHis').$request['riderid']; 
		$jobdata['job_date_time'] = $request['datetime'];
		$jobdata['job_type'] = $request['type'];
		$jobdata['job_ridetype'] = (isset($request['returnjourney']) && $request['returnjourney'] == 'Yes') ? 2 : 1;

		$locationlatlongarray = array();
		$sourcelocarray = array();
		$sourcelocarray['lat'] = $request['Source'][0]['lat'];
		$sourcelocarray['long'] = $request['Source'][0]['long'];
		array_push($locationlatlongarray,$sourcelocarray);
		
		if(isset($request['BetweenList']) && !empty($request['BetweenList']) && $request['BetweenList'] != "" && count($request['BetweenList']) > 0){
			$sortablelocationarray = array_sort($request['BetweenList'],'visitid');
			foreach($sortablelocationarray as $key=>$betnlocation){
				$betwlocarray = array();
				$betwlocarray['lat'] = $betnlocation['lat'];
				$betwlocarray['long'] = $betnlocation['long'];
				array_push($locationlatlongarray,$betwlocarray);
			}
		}
		
		$destlocarray = array();
		$destlocarray['lat'] = $request['Destination'][0]['lat'];
		$destlocarray['long'] = $request['Destination'][0]['long'];
		array_push($locationlatlongarray,$destlocarray);
		//dd($locationlatlongarray);
		
		$finaldistance = 0;
		$finaltime = 0;
		foreach($locationlatlongarray as $key=>$value){
			if($key != 0){
				$jobdistanceandtime = $this->getDistanceAndTime($locationlatlongarray[$key - 1]['lat'],$value['lat'],$locationlatlongarray[$key - 1]['long'],$value['long']);
				$finaldistance = $finaldistance + $jobdistanceandtime['distancevalue'];
				$finaltime = $finaltime + $jobdistanceandtime['timevalue'];
			}
		}
		$finaldistance = round($finaldistance / 1000 / 1.609344);
		$finaltime = round($finaltime / 60);
		//dd($finaldistance." / ".$finaltime);
		$jobdata['estimated_distance'] = $finaldistance;
		$jobdata['estimated_journey_time'] = $finaltime;
		//dd($jobdata);
		
		if($addedjob = Jobs::create($jobdata)){
			$jobdetails = array();
			$jobdetails['job_id'] = $addedjob->id;
			$jobdetails['no_of_passenger'] = $request['passanger'];
			$jobdetails['no_of_large_luggage'] = (isset($request['largeluggage']) && $request['largeluggage'] != NULL && $request['largeluggage'] != "") ? $request['largeluggage'] : 0;
			$jobdetails['no_of_small_luggage'] = (isset($request['smallluggage']) && $request['smallluggage'] != NULL && $request['smallluggage'] != "") ? $request['smallluggage'] : 0;
			$jobdetails['wheelchair_passenger'] = (isset($request['wheelchairpassanger']) && $request['wheelchairpassanger'] != NULL && $request['wheelchairpassanger'] != "") ? $request['wheelchairpassanger'] : 0;
			$jobdetails['no_of_childseats'] = (isset($request['child']) && $request['child'] != NULL && $request['child'] != "") ? $request['child'] : 0;
			$jobdetails['no_of_childbooster'] = (isset($request['childbooster']) && $request['childbooster'] != NULL && $request['childbooster'] != "") ? $request['childbooster'] : 0;
			$jobdetails['special_requirement'] = (isset($request['specialreq']) && $request['specialreq'] != NULL && $request['specialreq'] != "") ? $request['specialreq'] : '';
			
			if(JobDetails::create($jobdetails)){
				$joblocationsarray = array();
				
				//return $returnarray['Source'] = $request['Source'];
				$sourcearray = array();
				$sourcearray['job_id'] = $addedjob->id;
				$sourcearray['location_address'] = $request['Source'][0]['locationaddress'];
				$sourcearray['location_latitude'] = $request['Source'][0]['lat'];
				$sourcearray['location_longitude'] = $request['Source'][0]['long'];
				$sourcearray['location_type'] = 1;
				$sourcearray['ride_location_sequence'] = 1;
				$sourcearray['created_at'] = date('Y-m-d H:i:s');
				$sourcearray['updated_at'] = date('Y-m-d H:i:s');				
				array_push($joblocationsarray,$sourcearray);
				
				$i = 1;
				if(isset($request['BetweenList']) && !empty($request['BetweenList']) && $request['BetweenList'] != "" && count($request['BetweenList']) > 0){
					$sortablelocationarray = array_sort($request['BetweenList'],'visitid');
					foreach($sortablelocationarray as $key=>$betweenlocation){
						$i++;
						$betweenlocationarray = array();
						$betweenlocationarray['job_id'] = $addedjob->id;
						$betweenlocationarray['location_address'] = $betweenlocation['locationaddress'];
						$betweenlocationarray['location_latitude'] = $betweenlocation['lat'];
						$betweenlocationarray['location_longitude'] = $betweenlocation['long'];
						$betweenlocationarray['location_type'] = 3;
						$betweenlocationarray['ride_location_sequence'] = $i;
						$betweenlocationarray['created_at'] = date('Y-m-d H:i:s');
						$betweenlocationarray['updated_at'] = date('Y-m-d H:i:s');
						array_push($joblocationsarray,$betweenlocationarray);
					}
				}
				
				$destinationarray = array();
				$destinationarray['job_id'] = $addedjob->id;
				$destinationarray['location_address'] = $request['Destination'][0]['locationaddress'];
				$destinationarray['location_latitude'] = $request['Destination'][0]['lat'];
				$destinationarray['location_longitude'] = $request['Destination'][0]['long'];
				$destinationarray['location_type'] = 2;
				$destinationarray['ride_location_sequence'] = $i + 1;
				$destinationarray['created_at'] = date('Y-m-d H:i:s');
				$destinationarray['updated_at'] = date('Y-m-d H:i:s');
				array_push($joblocationsarray,$destinationarray);
				
				if(JobLocations::insert($joblocationsarray)){
					$returnarray['msg'] = 'Job added successfully';
					$returnarray['status'] = 1;
					$returnarray['jobid'] = $addedjob->job_id;
					$returnarray['id'] = $addedjob->id;		
				}
				else{
					$returnarray['errormsg'] = 'Some problem occured to add job location details.';
					$returnarray['status'] = 0;
				}
			}
			else{
				$returnarray['errormsg'] = 'Some problem occured to add job passanger details.';
				$returnarray['status'] = 0;
			}
		}
		else{
			$returnarray['errormsg'] = 'Some problem occured to add job.';
			$returnarray['status'] = 0;
		}
		return $returnarray;				
    }
	
	/**
     * Get My Booked Job List.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMyBookedJobList($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'riderid' => 'required',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$mybookingjobs = Jobs::with('Jobdetails','Jobbetweenlocations','ConfirmedBid')->where('rider_id',$request['riderid'])->where('job_status',4)->get();
		
		if(empty($mybookingjobs) || count($mybookingjobs) == 0){
			$returnarray['errormsg'] = 'No Jobs found for this user.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($mybookingjobs);
			$finaljobarray = array();
			foreach($mybookingjobs as $booking){
				$individualjob = array();
				$individualjob['Id'] = $booking['id'];
				$individualjob['JobId'] = $booking['job_id'];
				$individualjob['JobDateTime'] = strtoupper(date("j M Y, g:i:s a", strtotime($booking['job_date_time'])));
				$individualjob['JobType'] = ($booking['job_type'] == 1)? 'Job Now' : 'Job Later';
				$individualjob['EstimatedDistance'] = $booking['estimated_distance'];
				$individualjob['EstimatedJourneyTime'] = $booking['estimated_journey_time'];
				if(!empty($booking['ConfirmedBid']) && count($booking['ConfirmedBid']) > 0){
					$individualjob['DriverName'] = $booking['ConfirmedBid']['Driverdetails']['name'];
					$individualjob['DriverAvatar'] = $booking['ConfirmedBid']['Driverdetails']['driver_avatar'];
					$individualjob['VehicleName'] = $booking['ConfirmedBid']['Cabdetails']['vehicle_name'];
					$individualjob['VehicleImage'] = $booking['ConfirmedBid']['Cabdetails']['vehicle_image'];
					$individualjob['BidAmount'] = $booking['ConfirmedBid']['bid_amount'];
				}
				
				$individualjob['BetweenList'] = array();
				foreach($booking['Jobbetweenlocations'] as $location){
					$locationarray = array();
					$locationarray['VisitId'] = $location['ride_location_sequence'];
					$locationarray['Address'] = $location['location_address'];
					$locationarray['Lat'] = $location['location_latitude'];
					$locationarray['Long'] = $location['location_longitude'];
					
					if($location['location_type'] == 1){
						$individualjob['Source'] = $locationarray;
					}
					elseif($location['location_type'] == 2){
						$individualjob['Destination'] = $locationarray;
					}
					else{
						array_push($individualjob['BetweenList'],$locationarray);
					}
				}
				if(count($individualjob['BetweenList']) == 0){ unset($individualjob['BetweenList']); }
				array_push($finaljobarray,$individualjob);
			}
			$returnarray['msg'] = 'Jobs fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['MyBookingList'] = $finaljobarray;
		}
		return $returnarray;
    }
	
	/**
     * Get My Pending Job List.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMyPendingJobList($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'riderid' => 'required',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$mybookingjobs = Jobs::with('Jobdetails','Jobbetweenlocations')->where('rider_id',$request['riderid'])->whereIn('job_status', [1, 2, 3])->get();
		
		if(empty($mybookingjobs) || count($mybookingjobs) == 0){
			$returnarray['errormsg'] = 'No Jobs found for this user.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($mybookingjobs);
			$finaljobarray = array();
			foreach($mybookingjobs as $booking){	 
				$individualjob = array();
				$individualjob['Id'] = $booking['id'];
				$individualjob['JobId'] = $booking['job_id'];
				$individualjob['JobDateTime'] = strtoupper(date("j M Y, g:i:s a", strtotime($booking['job_date_time'])));
				$individualjob['JobType'] = ($booking['job_type'] == 1)? 'Job Now' : 'Job Later';
				$individualjob['EstimatedDistance'] = $booking['estimated_distance'];
				$individualjob['EstimatedJourneyTime'] = $booking['estimated_journey_time'];
				
				$individualjob['BetweenList'] = array();
				foreach($booking['Jobbetweenlocations'] as $location){
					$locationarray = array();
					$locationarray['VisitId'] = $location['ride_location_sequence'];
					$locationarray['Address'] = $location['location_address'];
					$locationarray['Lat'] = $location['location_latitude'];
					$locationarray['Long'] = $location['location_longitude'];
					
					if($location['location_type'] == 1){
						$individualjob['Source'] = $locationarray;
					}
					elseif($location['location_type'] == 2){
						$individualjob['Destination'] = $locationarray;
					}
					else{
						array_push($individualjob['BetweenList'],$locationarray);
					}
				}
				if(count($individualjob['BetweenList']) == 0){ unset($individualjob['BetweenList']); }
				array_push($finaljobarray,$individualjob);
			}
			$returnarray['msg'] = 'Pending Jobs fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['MyBookingList'] = $finaljobarray;
		}
		return $returnarray;
    }
	
	/**
     * Get Job with all it's Details.
     *
     * @return Job Details
     */
    public function myJobDetail($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'jobid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$booking = Jobs::with('Jobdetails','Jobbetweenlocations','ConfirmedBid')->where('id','=',$request['jobid'])->first();
		if(empty($booking) || count($booking) == 0){
			$returnarray['errormsg'] = 'No details found for this Job.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($booking);
			$finaljobarray = array();
			$individualjob = array();
			$individualjob['Id'] = $booking->id;
			$individualjob['JobId'] = $booking->job_id;
			$individualjob['JobDateTime'] = strtoupper(date("j M Y, g:i:s a", strtotime($booking->job_date_time)));
			$individualjob['JobType'] = ($booking->job_type == 1) ? 'Job Now' : 'Job Later';
			$individualjob['EstimatedDistance'] = $booking->estimated_distance;
			$individualjob['EstimatedJourneyTime'] = $booking->estimated_journey_time;
			if(!empty($booking->ConfirmedBid) && count($booking->ConfirmedBid) > 0){
				$individualjob['DriverName'] = $booking->ConfirmedBid['Driverdetails']['name'];
				$individualjob['DriverAvatar'] = $booking->ConfirmedBid['Driverdetails']['driver_avatar'];
				$individualjob['VehicleName'] = $booking->ConfirmedBid['Cabdetails']['vehicle_name'];
				$individualjob['VehicleImage'] = $booking->ConfirmedBid['Cabdetails']['vehicle_image'];
			}
			$individualjob['BetweenList'] = array();
			foreach($booking->Jobbetweenlocations as $location){
				$locationarray = array();
				$locationarray['VisitId'] = $location['ride_location_sequence'];
				$locationarray['Address'] = $location['location_address'];
				$locationarray['Lat'] = $location['location_latitude'];
				$locationarray['Long'] = $location['location_longitude'];
				
				if($location['location_type'] == 1){
					$individualjob['Source'] = $locationarray;
				}
				elseif($location['location_type'] == 2){
					$individualjob['Destination'] = $locationarray;
				}
				else{
					array_push($individualjob['BetweenList'],$locationarray);
				}
			}
			if(count($individualjob['BetweenList']) == 0){ unset($individualjob['BetweenList']); }
			array_push($finaljobarray,$individualjob);
						
			$returnarray['msg'] = 'Jobs Details fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['JobInformation'] = $finaljobarray;	
		}
		return $returnarray;
    }
	
	/**
     * Get My Job History.
     *
     * @return \Illuminate\Http\Response
     */
    public function getJobHistory($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'riderid' => 'required',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$mybookingjobs = Jobs::with('Jobdetails','Jobbetweenlocations','ConfirmedBid')->where('rider_id',$request['riderid'])->whereIn('job_status',[6,7,8])->get();
		
		if(empty($mybookingjobs) || count($mybookingjobs) == 0){
			$returnarray['errormsg'] = 'No Jobs found for this user.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($mybookingjobs);
			$finaljobarray = array();
			foreach($mybookingjobs as $booking){
				$individualjob = array();
				$individualjob['Id'] = $booking['id'];
				$individualjob['JobId'] = $booking['job_id'];
				$individualjob['JobDateTime'] = strtoupper(date("j M Y, g:i:s a", strtotime($booking['job_date_time'])));
				//$individualjob['JobType'] = ($booking['job_type'] == 1)? 'Job Now' : 'Job Later';
				
				if(!empty($booking['ConfirmedBid']) && count($booking['ConfirmedBid']) > 0){
					$individualjob['JobCost'] = $booking['ConfirmedBid']['bid_amount'];
					$individualjob['DriverName'] = $booking['ConfirmedBid']['Driverdetails']['name'];
					$individualjob['DriverAvatar'] = $booking['ConfirmedBid']['Driverdetails']['driver_avatar'];
					$individualjob['VehicleName'] = $booking['ConfirmedBid']['Cabdetails']['vehicle_name'];
					$individualjob['VehicleImage'] = $booking['ConfirmedBid']['Cabdetails']['vehicle_image'];
				}
				foreach($booking['Jobbetweenlocations'] as $location){
					if($location['location_type'] == 1){
						$individualjob['Source'] = $location['location_address'];
					}
					elseif($location['location_type'] == 2){
						$individualjob['Destination'] = $location['location_address'];
					}
				}
				if($booking['job_status'] == 6){
					$individualjob['JobStatus'] = 'Completed';
				}
				elseif($booking['job_status'] == 7){
					$individualjob['JobStatus'] = 'Cancelled';
				}
				else{
					$individualjob['JobStatus'] = 'Aborted';
				}
				array_push($finaljobarray,$individualjob);
			}
			$returnarray['msg'] = 'Jobs fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['HistoryList'] = $finaljobarray;
		}
		return $returnarray;
    }
	
	/**
     * Cancel My Job.
     *
     * @return Cancelled Status
     */
    public function cancelMyJob($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'riderid' => 'required',
			'jobid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$jobdata = Jobs::where('rider_id','=',trim($request['riderid']))->where('id','=',trim($request['jobid']))->first();
		if(empty($jobdata) || count($jobdata) == 0){
			$returnarray['errormsg'] = 'No Job found for entered ID OR Given Job are not related to given Rider ID.';
			$returnarray['status'] = 0;
		}
		else{
			$jobdata->job_status = 7;
			if($jobdata->update()){
				$returnarray['status'] = 1;
				$returnarray['msg'] = 'Booking cancelled successfully';
				$returnarray['BookingStatus'] = "Cancelled";
			}
			else{
				$returnarray['errormsg'] = 'Some problem occured to cancelled Job. Please try after some time.';
				$returnarray['status'] = 0;
			}	
		}
		return $returnarray;
    }
	
	/**
     * Get All Applied Bid for given Job ID.
     *
     * @return All Applied Job
     */
    public function getAppliedBids($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'jobid' => 'required',
			'riderid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$jobdata = Jobs::with('AppliedBid','Jobbetweenlocations')->where('rider_id','=',$request['riderid'])->where('id','=',$request['jobid'])->first();
		
		if(empty($jobdata) && count($jobdata) == 0){
			$returnarray['errormsg'] = 'This job is not created by given rider.';
			$returnarray['status'] = 0;
		}
		elseif(empty($jobdata->AppliedBid) || count($jobdata->AppliedBid) == 0){
			$returnarray['errormsg'] = 'No Bids Applied for this Job.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($booking);
			$finaljobarray = array();
			
			$individualjob['Id'] = $jobdata->id;
			$individualjob['JobId'] = $jobdata->job_id;
			$individualjob['JobDateTime'] = $jobdata->job_date_time;
			$individualjob['JobType'] = ($jobdata->job_type == 1) ? 'Job Now' : 'Job Later';
			$individualjob['EstimatedDistance'] = $jobdata->estimated_distance;
			$individualjob['EstimatedJourneyTime'] = $jobdata->estimated_journey_time;
			
			$individualjob['BetweenList'] = array();
			foreach($jobdata->Jobbetweenlocations as $location){
				$locationarray = array();
				$locationarray['VisitId'] = $location['ride_location_sequence'];
				$locationarray['Address'] = $location['location_address'];
				$locationarray['Lat'] = $location['location_latitude'];
				$locationarray['Long'] = $location['location_longitude'];
				
				if($location['location_type'] == 1){
					$individualjob['Source'] = $locationarray;
				}
				elseif($location['location_type'] == 2){
					$individualjob['Destination'] = $locationarray;
				}
				else{
					array_push($individualjob['BetweenList'],$locationarray);
				}
			}
			if(count($individualjob['BetweenList']) == 0){ unset($individualjob['BetweenList']); }
			array_push($finaljobarray,$individualjob);
			
			$bidsarray = array();			
			foreach($jobdata->AppliedBid as $individualbid){
				$individualjob = array();
				$individualjob['BidID'] = $individualbid['id'];
				$individualjob['DriverName'] = $individualbid['Driverdetails']['name'];
				$individualjob['DriverAvatar'] = $individualbid['Driverdetails']['driver_avatar'];
				$individualjob['DriverRating'] = $individualbid['Driverdetails']['driver_avg_rating'];
				$individualjob['VehicleName'] = $individualbid['Cabdetails']['vehicle_name'];
				$individualjob['VehicleImage'] = $individualbid['Cabdetails']['vehicle_image'];
				$individualjob['BidAmount'] = $individualbid['bid_amount'];
				$individualjob['BidType'] = ($individualbid['bid_type'] == 1)? 'Fixed Cost' : 'Bargain Cost';
				array_push($bidsarray,$individualjob);
			}
						
			$returnarray['msg'] = 'Jobs Details fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['JobInformation'] = $finaljobarray;
			$returnarray['Appliedbids'] = $bidsarray;		
		}
		return $returnarray;
    }
	
	/**
     * Get Bid Details for Job.
     *
     * @return Bid Information with Driver details
     */
    public function getBidDetails($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'bidid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$biddata = JobBids::with('Driverdetails','Cabdetails')->find($request['bidid']);
				
		if(empty($biddata) || count($biddata) == 0){
			$returnarray['errormsg'] = 'No Bid exist for given ID. Invalid Bid';
			$returnarray['status'] = 0;
		}
		else{
			$individualjob = array();
			$individualjob['BidID'] = $biddata->id;
			$individualjob['DriverName'] = $biddata->Driverdetails['name'];
			$individualjob['DriverAvatar'] = $biddata->Driverdetails['driver_avatar'];
			$individualjob['DriverRating'] = $biddata->Driverdetails['driver_avg_rating'];
			$individualjob['VehicleName'] = $biddata->Cabdetails['vehicle_name'];
			$individualjob['VehicleImage'] = $biddata->Cabdetails['vehicle_image'];
			$individualjob['BidAmount'] = $biddata->bid_amount;
			$individualjob['BidType'] = ($biddata->bid_type == 1)? 'Fixed Cost' : 'Bargain Cost';
			
			$returnarray['msg'] = 'Bid Details fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['BidInfo'] = $individualjob;
		}
		return $returnarray;
    }
	
	/**
     * Get Online Driver Distance Time from source address.
     *
     * @return Driver away time.
     */
    public function awayFromPickupLocation($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'bidid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$biddata = JobBids::with('Driverdetails','Cabdetails')->find($request['bidid']);
				
		if(empty($biddata) || count($biddata) == 0){
			$returnarray['errormsg'] = 'No Bid exist for given ID. Invalid Bid';
			$returnarray['status'] = 0;
		}
		else{
			$individualjob = array();
			$individualjob['BidID'] = $biddata->id;
			$individualjob['DriverName'] = $biddata->Driverdetails['name'];
			$individualjob['DriverAvatar'] = $biddata->Driverdetails['driver_avatar'];
			$individualjob['DriverRating'] = $biddata->Driverdetails['driver_avg_rating'];
			$individualjob['VehicleName'] = $biddata->Cabdetails['vehicle_name'];
			$individualjob['VehicleImage'] = $biddata->Cabdetails['vehicle_image'];
			$individualjob['BidAmount'] = $biddata->bid_amount;
			$individualjob['BidType'] = ($biddata->bid_type == 1)? 'Fixed Cost' : 'Bargain Cost';
			
			$jobdata = Jobs::select('job_type')->where('id','=',$biddata->job_id)->first();
			if($jobdata->job_type == 1){
				$jobsourceaddress = JobLocations::where('job_id','=',$biddata->job_id)->where('location_type','=',1)->first();
				$driverlocationdata = DriverStatusLocation::where('driver_id','=',$biddata->Driverdetails['id'])->first();
				$estimateddistanceandtime = $this->getDistanceAndTime($jobsourceaddress->location_latitude,$driverlocationdata->lat,$jobsourceaddress->location_longitude,$driverlocationdata->lang);
				$individualjob['AwayMinute'] = $estimateddistanceandtime['time'];
			}
			//dd($estimateddistanceandtime);
			
			$returnarray['msg'] = 'Bid Details fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['BidInfo'] = $individualjob;
		}
		return $returnarray;
    }
	
	
	/**
     * Send Request To Driver for Bid.
     *
     * @return Send Request Status
     */
    public function sendRequestToDriver($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'bidid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$biddata = JobBids::find($request['bidid']);		
		if(empty($biddata) || count($biddata) == 0){
			$returnarray['errormsg'] = 'No Bid exist for given ID. Invalid Bid';
			$returnarray['status'] = 0;
		}
		else{
			$biddata->job_bids_status = 1;
			
			if($biddata->update()){
				$returnarray['msg'] = 'Request send to driver successfully';
				$returnarray['status'] = 1;
				$returnarray['BidID'] = $request['bidid'];
			}
			else{
				$returnarray['msg'] = 'Problem occured to send request to driver. Please try after some time.';
				$returnarray['status'] = 0;
			}		
		}
		return $returnarray;
    }
	
	/**
     * Give Rating To Driver After Job Completion.
     *
     * @return Rating and Comment submit Status
     */
    public function giveDriverRating($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'jobid' => 'required|numeric',
			'rating' => 'required'
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$jobdata = Jobs::has('ConfirmedBid')->with('ConfirmedBid')->where('job_status','=','6')->find($request['jobid']);
		//dd($jobdata);
							
		if(empty($jobdata) || count($jobdata) == 0 || count($jobdata) == NULL){
			$returnarray['errormsg'] = 'No Job found for given ID. Invalid Job.';
			$returnarray['status'] = 0;
		}
		else{
			$jobratingdata = JobRatings::where('job_id','=',$request['jobid'])->first();
			if(empty($jobratingdata) || count($jobratingdata) == 0){
				$ratingArray = array();
				$ratingArray['job_id'] = $request['jobid'];
				$ratingArray['driver_id'] = $jobdata->ConfirmedBid['driver_id'];
				$ratingArray['driver_rating'] = $request['rating'];
				$ratingArray['driver_experience_comment'] = (isset($request['comment']) && $request['comment'] != "" && $request['comment'] != NULL) ? $request['comment'] : NULL;
				
				if(JobRatings::create($ratingArray)){
					$averagedriverrating = JobRatings::where('driver_id','=',$jobdata->ConfirmedBid->driver_id)->avg('driver_rating');
					$driverdata = Drivers::find($jobdata->ConfirmedBid->driver_id);
					$driverdata->driver_avg_rating = round($averagedriverrating,2);
					$driverdata->update();
					
					$returnarray['msg'] = 'Rating for driver submitted successfully';
					$returnarray['status'] = 1;
					$returnarray['jobid'] = $request['jobid'];
				}
				else{
					$returnarray['errormsg'] = 'Problem occured to submit the rating for driver. Please try after some time.';
					$returnarray['status'] = 0;
				}
			}
			else{
				$jobratingdata->driver_id = $jobdata->ConfirmedBid['driver_id'];
				$jobratingdata->driver_rating = $request['rating'];
				$jobratingdata->driver_experience_comment = (isset($request['comment']) && $request['comment'] != "" && $request['comment'] != NULL) ? $request['comment'] : NULL;
				
				if($jobratingdata->update()){
					$averagedriverrating = JobRatings::where('driver_id','=',$jobdata->ConfirmedBid->driver_id)->avg('driver_rating');
					$driverdata = Drivers::find($jobdata->ConfirmedBid->driver_id);
					$driverdata->driver_avg_rating = round($averagedriverrating,2);
					$driverdata->update();
					
					$returnarray['msg'] = 'Rating for driver submitted successfully';
					$returnarray['status'] = 1;
					$returnarray['jobid'] = $request['jobid'];
				}
				else{
					$returnarray['msg'] = 'Problem occured to submit the rating for driver. Please try after some time.';
					$returnarray['status'] = 0;
				}		
			}
		}
		
		return $returnarray;
    }
	
	/**
     * Update Driver Status Location.
     *
     * @return Driver id with available status
     */
    public function changeDriverStatusLocation($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
			'lat' => 'required', 
			'long' => 'required',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$driverdata = Drivers::with('Drivercars')->where('driver_status','1')->find($request['driverid']);		
		if(empty($driverdata) || count($driverdata) == 0){
			$returnarray['errormsg'] = 'Driver not exist. Invalid Driver';
			$returnarray['status'] = 0;
		}
		else{
			//dd($driverdata);
			if(isset($request['currentstatus']) && $request['currentstatus'] == "Online"){
				$errflag = 0;	
				if($driverdata->driver_licence_no == "" || $driverdata->driver_licence_no == NULL){
					$returnarray['msg'] = 'Licence no is missing for given driver. Please register driving licence no.';
					$returnarray['status'] = 0;
					$errflag = 1;
				}
				elseif($driverdata->licence_expire_date == '' || $driverdata->licence_expire_date == NULL || strtotime($driverdata->licence_expire_date) < strtotime(date('Y-m-d'))){
					$returnarray['msg'] = 'Your licence validity has been expired. Please renew your licence.';
					$returnarray['status'] = 0;
					$errflag = 1;
				}
				elseif($driverdata->profile_details_verification != 1 || $driverdata->licence_details_verification != 1){
					$returnarray['msg'] = 'Your profile OR licence details are not beign verified by admin till now.';
					$returnarray['status'] = 0;
					$errflag = 1;
				}
				elseif(empty($driverdata->Drivercars) || count($driverdata->Drivercars) == 0){
					$returnarray['msg'] = 'No registered vehicle is found. Please register atleast one vehicle.';
					$returnarray['status'] = 0;
					$errflag = 1;
				}
				
				if($errflag == 1){ return $returnarray; }
			}
			
			$driverlocationdata = DriverStatusLocation::where('driver_id',$request['driverid'])->first();
			if(empty($driverlocationdata) || count($driverlocationdata) == 0){
				$dataArray = array();
				$dataArray['driver_id'] = $request['driverid'];
				$dataArray['available_status'] = (isset($request['currentstatus']) && $request['currentstatus'] == "Online") ? 1 : 2;
				$dataArray['lat'] = $request['lat'];
				$dataArray['lang'] = $request['long'];
				$dataArray['lock_bid'] = (isset($request['lock_bid']) && $request['lock_bid'] == "Yes") ? 1 : 0;
				
				if(DriverStatusLocation::create($dataArray)){
					$returnarray['driverid'] = $request['driverid'];
					$returnarray['currentstatus'] = (isset($request['currentstatus']) && $request['currentstatus'] == "Online") ? $request['currentstatus'] : 'Offline';
					$returnarray['applybid'] = (isset($request['lockbid']) && $request['lockbid'] == "Yes") ? "Not Allowed" : "Alloweb to bid";
					$returnarray['msg'] = 'Rider location and status updated successfully';
					$returnarray['status'] = 1;
				}
				else{
					$returnarray['msg'] = 'Problem occured to update driver statua and location';
					$returnarray['status'] = 0;
				}
			}
			else{
				
				if(isset($request['currentstatus']) && $request['currentstatus'] == "Online"){
					if($driverlocationdata->lock_bid == 1){
						$returnarray['msg'] = 'You have been locked to apply for the bid. Please contact admin for more information.';
						$returnarray['status'] = 0;
						return $returnarray;
					}
				}
				
				if(isset($request['currentstatus']) && $request['currentstatus'] != "" && $request['currentstatus'] != NULL){
					$driverlocationdata->available_status =  ($request['currentstatus'] == "Online") ? 1 : 2;
				}
				if(isset($request['lat']) && $request['lat'] != "" && $request['lat'] != NULL){
					$driverlocationdata->lat = $request['lat'];
				}
				if(isset($request['long']) && $request['long'] != "" && $request['long'] != NULL){
					$driverlocationdata->lang = $request['long'];
				}
				if(isset($request['lockbid']) && $request['lockbid'] != "" && $request['lockbid'] != NULL){
					$driverlocationdata->lock_bid = (isset($request['lockbid']) && $request['lockbid'] == "Yes") ? 1 : 0;
				}
				
				if($driverlocationdata->update()){
					$returnarray['driverid'] = $request['driverid'];
					$returnarray['currentstatus'] = ($driverlocationdata->available_status == 1) ? "Online" : "Offline";
					$returnarray['applybid'] = ($driverlocationdata->lock_bid == 1) ? "Not Allowed" : "Alloweb to bid";
					$returnarray['msg'] = 'Rider location and status updated successfully';
					$returnarray['status'] = 1;
				}
				else{
					$returnarray['msg'] = 'Problem occured to update driver statua and location';
					$returnarray['status'] = 0;
				}
			}
		}
		return $returnarray;
    }
	
	/**
     * Get Driver Current Status Location.
     *
     * @return Driver with current status and location
     */
    public function getDriverCurrentStatusLocation($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$driverdata = Drivers::where('driver_status','1')->find($request['driverid']);		
		if(empty($driverdata) || count($driverdata) == 0){
			$returnarray['errormsg'] = 'Driver not exist. Invalid Driver';
			$returnarray['status'] = 0;
		}
		else{
			$driverlocationdata = DriverStatusLocation::where('driver_id',$request['driverid'])->first();
			if(empty($driverlocationdata) || count($driverlocationdata) == 0){
				$returnarray['msg'] = 'No location and current status registered for this driver. Please register once driver status and location';
				$returnarray['status'] = 0;
			}
			else{
				$returnarray['driverid'] = $request['driverid'];
				$returnarray['lat'] = $driverlocationdata->lat;
				$returnarray['long'] = $driverlocationdata->lang;
				$returnarray['currentstatus'] = ($driverlocationdata->available_status == 1) ? "Online" : "Offline";
				$returnarray['applybid'] = ($driverlocationdata->lock_bid == 1) ? "Not Allowed" : "Alloweb to bid";
				$returnarray['msg'] = 'Driver current status and location fetched successfully';
				$returnarray['status'] = 1;
			}
		}
		return $returnarray;
    }
	
	/**
     * Get CMS Page Info.
     *
     * @return CMS Page
     */
    public function getCMSInfo($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'pagename' => 'required',
			'pagefor' => 'required',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$cmsdata = CMS::where('cms_page_name','=',trim($request['pagename']))->where('cms_page_for','=',trim($request['pagefor']))->where('cms_page_status','=','1')->first();
		if(empty($cmsdata) || $cmsdata == NULL || count($cmsdata) == 0){
			$returnarray['errormsg'] = 'CMS Page Not Found';
			$returnarray['status'] = 0;
		}
		else{
			$returnarray['msg'] = 'success';
			$cmsinfo = array();
			$cmsinfo['page_name'] = $cmsdata['cms_page_name'];
			$cmsinfo['page_content'] = $cmsdata['cms_page_content'];
			$cmsinfo['page_for'] = $cmsdata['cms_page_for'];
			$returnarray['pageinfo'] = $cmsinfo;
			$returnarray['status'] = 1;
		}
		return $returnarray;
    }
	
	/**
     * Get Splash Screens Information.
     *
     * @return Splash Screen Array
     */
    public function getSplashScreens($request){
		//dd($request); 
		$validator = Validator::make($request, [
			'appuser' => 'required',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$screendata = SplashScreens::where('app_user','=',trim($request['appuser']))->where('slider_status','=','1')->inRandomOrder()->limit(3)->get();
		if(empty($screendata) || $screendata == NULL || count($screendata) == 0){
			$returnarray['errormsg'] = 'No Splash Screen found for given user';
			$returnarray['status'] = 0;
		}
		else{
			$finalscreenarray = array();
			foreach($screendata as $screen){
				$screeninfo = array();
				$screeninfo['content'] = $screen['slider_content'];
				$screenimagepath = ($request['appuser'] == "Driver") ? URL::to('images/splash/driver') : URL::to('images/splash/rider') ;
				$screeninfo['image'] = $screenimagepath.'/'.$screen['slider_image'];
				array_push($finalscreenarray,$screeninfo);
			}
			$returnarray['status'] = 1;
			$returnarray['msg'] = 'success';
			$returnarray['splashscreens'] = $finalscreenarray;
		}
		return $returnarray;
    }
	
	/**
     * Driver Section Related APIs.
     */
	
	/**
     * Give Rating To Rider After Job Completion.
     *
     * @return Rating and Comment submit Status
     */
    public function getDriverCurrentVehicle($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$driverdata = Drivers::with('Drivercurrentvehicle')->find($request['driverid']);
		if(empty($driverdata) || count($driverdata) == 0){
			$returnarray['errormsg'] = 'No driver data found for given ID. Invalid Driver.';
			$returnarray['status'] = 0;
		}
		else{
			if($driverdata->Drivercurrentvehicle == NULL || $driverdata->Drivercurrentvehicle == ''){
				$returnarray['errormsg'] = 'No current vehicle is set for given driver.';
				$returnarray['status'] = 0;
			}
			else{
				$vehicledata = array();
				$vehicledata['VehicleName'] = $driverdata->Drivercurrentvehicle->vehicle_name;
				$vehicledata['VehicleCompany'] = $driverdata->Drivercurrentvehicle->vehicle_company;
				$vehicledata['VehicleColour'] = $driverdata->Drivercurrentvehicle->vehicle_colour;
				$vehicledata['VehicleImage'] = $driverdata->Drivercurrentvehicle->vehicle_image;
				
				$returnarray['msg'] = 'Current car details fetched successfully';
				$returnarray['status'] = 1;
				$returnarray['VehicleData'] = $vehicledata;
			}
		}
		
		return $returnarray;
    }
	
	/**
     * Give Rating To Rider After Job Completion.
     *
     * @return Rating and Comment submit Status
     */
    public function setDriverCurrentVehicle($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
			'vehicleid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$drivervehicledata = DriverVehicles::has('Driverdata')->with('Driverdata')->where('driver_id','=',$request['driverid'])->find($request['vehicleid']);
		if(empty($drivervehicledata) || count($drivervehicledata) == 0){
			$returnarray['errormsg'] = 'No vehicle is associated for given Driver ID.';
			$returnarray['status'] = 0;
		}
		else{
			if(Drivers::where('id', $request['driverid'])->update(['driver_current_car' => $request['vehicleid']])){
				$returnarray['msg'] = 'Current car set successfully for given driver';
				$returnarray['status'] = 1;
			}
			else{
				$returnarray['errormsg'] = 'Problem occured to set this vehicle as current vehicle. Please try after some time.';
				$returnarray['status'] = 0;
			}
		}
		
		return $returnarray;
    }
	
	/**
     * Get all vehicle registered by driver.
     *
     * @return Vehicle list
     */
    public function getAllDriverVehicle($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$vehicledata = DriverVehicles::where('driver_id','=',$request['driverid'])->where('vehicle_status','=','1')->get();
		if(empty($vehicledata) || count($vehicledata) == 0){
			$returnarray['errormsg'] = 'No vehicles found for given Driver.';
			$returnarray['status'] = 0;
		}
		else{
			$driverdata = Drivers::find($request['driverid']);
			$currentvehicledata = array();
			$finalvehicledata =  array();
			foreach($vehicledata as $vehicle){
				if($driverdata->driver_current_car != NULL && $driverdata->driver_current_car != '' && $driverdata->driver_current_car == $vehicle['id']){
					$currentvehicledata['VehicleID'] = $vehicle['id'];
					$currentvehicledata['VehicleName'] = $vehicle['vehicle_name'];
					$currentvehicledata['VehicleCompany'] = $vehicle['vehicle_company'];
					$currentvehicledata['VehicleColour'] = $vehicle['vehicle_colour'];
					$currentvehicledata['VehicleImage'] = $vehicle['vehicle_image'];		
				}
				else{
					$vehicledata = array();
					$vehicledata['VehicleID'] = $vehicle['id'];
					$vehicledata['VehicleName'] = $vehicle['vehicle_name'];
					$vehicledata['VehicleCompany'] = $vehicle['vehicle_company'];
					$vehicledata['VehicleColour'] = $vehicle['vehicle_colour'];
					$vehicledata['VehicleImage'] = $vehicle['vehicle_image'];
					array_push($finalvehicledata, $vehicledata);
				}
			}
			$returnarray['msg'] = 'Vehicle details fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['VehicleData'] = $finalvehicledata;
			$returnarray['CurrentVehicleData'] = $currentvehicledata;
		}
		
		return $returnarray;
    }
	
	/**
     * Add New Vehicle.
     *
     * @return Vehicle add status
     */
    public function addNewVehicle($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required',
			'vehicle_name' => 'required',
			//'vehicle_type' => 'required',
			//'vehicle_company' => 'required',
			'vehicle_colour' => 'required',
			'vehicle_number_plate' => 'required|unique:driver_vehicles',
			'vehicle_image' => 'required',
			'passanger_capacity' => 'required|numeric',
			'wheelchair_passanger_capacity' => 'required|numeric',
			'child_seat_capacity' => 'required|numeric',
			'child_booster_capacity' => 'required|numeric',
			'large_luggage_capacity' => 'required|numeric',
			'small_luggage_capacity' => 'required|numeric',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$vehicledata = array();
		$vehicledata['driver_id'] = $request['driverid'];
		$vehicledata['vehicle_name'] = $request['vehicle_name'];
		$vehicledata['vehicle_type'] = (isset($request['vehicle_type']) && $request['vehicle_type'] != NULL) ? $request['vehicle_type'] : NULL;
		$vehicledata['vehicle_make_model'] = (isset($request['vehicle_make_model']) && $request['vehicle_make_model'] != NULL) ? $request['vehicle_make_model'] : NULL;
		$vehicledata['vehicle_company'] = (isset($request['vehicle_company']) && $request['vehicle_company'] != NULL) ? $request['vehicle_company'] : NULL;
		$vehicledata['vehicle_colour'] = $request['vehicle_colour'];
		$vehicledata['vehicle_number_plate'] = $request['vehicle_number_plate'];
		$imagename = "mainimage.jpg";
		$vehicledata['vehicle_image'] = $request['vehicle_image'];
		$vehicledata['passanger_capacity'] = (isset($request['passanger_capacity']) && $request['passanger_capacity'] != NULL)? $request['passanger_capacity'] : 0;
		$vehicledata['wheelchair_passanger_capacity'] = (isset($request['wheelchair_passanger_capacity']) && $request['wheelchair_passanger_capacity'] != NULL)? $request['wheelchair_passanger_capacity'] : 0;
		$vehicledata['child_seat_capacity'] = (isset($request['child_seat_capacity']) && $request['child_seat_capacity'] != NULL)? $request['child_seat_capacity'] : 0;
		$vehicledata['child_booster_capacity'] = (isset($request['child_booster_capacity']) && $request['child_booster_capacity'] != NULL)? $request['child_booster_capacity'] : 0;
		$vehicledata['large_luggage_capacity'] = (isset($request['large_luggage_capacity']) && $request['large_luggage_capacity'] != NULL)? $request['large_luggage_capacity'] : 0;
		$vehicledata['small_luggage_capacity'] = (isset($request['small_luggage_capacity']) && $request['small_luggage_capacity'] != NULL)? $request['small_luggage_capacity'] : 0;
		//dd($vehicledata);
		
		if($newvehicaldata = DriverVehicles::create($vehicledata)){
			
			/*$path = public_path().'/images/vehicles/'.$newvehicaldata->id;
			File::makeDirectory($path, $mode = 0777, true, true);
			$imagepathpath = $path.'/'.$imagename;
			$img = $request['vehicle_image'];
			$img = substr($img, strpos($img, ",")+1);
			$data = base64_decode($img);
			$success = file_put_contents($imagepathpath, $data);*/
				
			$returnarray['msg'] = 'Vehicle details added successfully';
			$returnarray['status'] = 1;
			$returnarray['VehicleID'] = $newvehicaldata->id;
			$returnarray['VehicleImage'] = $request['vehicle_image'];
		}
		else{
			$returnarray['errormsg'] = 'Some problem occured to add new vehicle.';
			$returnarray['status'] = 0;
		}
		
		return $returnarray;
    }
	
	/**
     * Edit Vehicle Details.
     *
     * @return Vehicle edit status
     */
    public function editVehicle($request){
		//dd($request); 
		$validator = Validator::make($request, [
			'vehicleid' => 'required|numeric',
			'driverid' => 'required|numeric',
			'vehicle_number_plate' => 'unique:driver_vehicles,vehicle_number_plate,'.$request['vehicleid'].',id',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$vehicledata = DriverVehicles::where('driver_id','=',$request['driverid'])->find($request['vehicleid']);
		if(empty($vehicledata) || count($vehicledata) == 0 || $vehicledata == NULL){
			$returnarray['errormsg'] = 'No vehicle details found for given vehicle ID with respect to driver ID.';
			$returnarray['status'] = 0;
		}
		else{
			if(isset($request['vehicle_name']) && $request['vehicle_name'] != NULL){
				$vehicledata->vehicle_name = $request['vehicle_name'];
			}
			if(isset($request['vehicle_type']) && $request['vehicle_type'] != NULL){
				$vehicledata->vehicle_type = $request['vehicle_type'];
			}
			if(isset($request['vehicle_company']) && $request['vehicle_company'] != NULL){
				$vehicledata->vehicle_company = $request['vehicle_company'];
			}
			if(isset($request['vehicle_image']) && $request['vehicle_image'] != NULL){
				$vehicledata->vehicle_image = $request['vehicle_image'];
			}
			if(isset($request['vehicle_make_model']) && $request['vehicle_make_model'] != NULL){
				$vehicledata->vehicle_make_model = $request['vehicle_make_model'];
			}
			if(isset($request['vehicle_colour']) && $request['vehicle_colour'] != NULL){
				$vehicledata->vehicle_colour = $request['vehicle_colour'];
			}
			if(isset($request['vehicle_number_plate']) && $request['vehicle_number_plate'] != NULL){
				$vehicledata->vehicle_number_plate = $request['vehicle_number_plate'];
			}
			if(isset($request['passanger_capacity']) && $request['passanger_capacity'] != NULL){
				$vehicledata->passanger_capacity = $request['passanger_capacity'];
			}
			if(isset($request['wheelchair_passanger_capacity']) && $request['wheelchair_passanger_capacity'] != NULL){
				$vehicledata->wheelchair_passanger_capacity = $request['wheelchair_passanger_capacity'];
			}
			if(isset($request['child_seat_capacity']) && $request['child_seat_capacity'] != NULL){
				$vehicledata->child_seat_capacity = $request['child_seat_capacity'];
			}
			if(isset($request['child_booster_capacity']) && $request['child_booster_capacity'] != NULL){
				$vehicledata->child_booster_capacity = $request['child_booster_capacity'];
			}
			if(isset($request['large_luggage_capacity']) && $request['large_luggage_capacity'] != NULL){
				$vehicledata->large_luggage_capacity = $request['large_luggage_capacity'];
			}
			if(isset($request['small_luggage_capacity']) && $request['small_luggage_capacity'] != NULL){
				$vehicledata->small_luggage_capacity = $request['small_luggage_capacity'];
			}
			
			if($vehicledata->update()){
				$imagename = "mainimage.jpg";
				/*if(isset($request['vehicle_image']) && $request['vehicle_image'] != NULL){
					$path = public_path().'/images/vehicles/'.$request['vehicleid'];
					File::makeDirectory($path, $mode = 0777, true, true);
					$imagepathpath = $path.'/'.$imagename;
					$img = $request['vehicle_image'];
					$img = substr($img, strpos($img, ",")+1);
					$data = base64_decode($img);
					$success = file_put_contents($imagepathpath, $data);
				}*/
				$returnarray['msg'] = 'Vehicle details updated successfully';
				$returnarray['status'] = 1;
				$returnarray['VehicleID'] = $request['vehicleid'];
				$returnarray['VehicleImage'] = (isset($request['vehicle_image']) && $request['vehicle_image'] != NULL)? $request['vehicle_image'] : $vehicledata->vehicle_image ;
			}
			else{
				$returnarray['errormsg'] = 'Problem occured in update vehicle details. Try after some time.';
				$returnarray['status'] = 0;
			}
		}
		return $returnarray;
    }
	
	/**
     * Get Vehicle Details.
     *
     * @return Vehicle details
     */
    public function getVehicleDetails($request){ 
		$validator = Validator::make($request, [           
			'vehicleid' => 'required|numeric',
			'driverid' => 'required|numeric'
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$vehicledata = DriverVehicles::with('Vehicleimages')->where('driver_id','=',$request['driverid'])->find($request['vehicleid']);
		if(empty($vehicledata) || count($vehicledata) == 0 || $vehicledata == NULL){
			$returnarray['errormsg'] = 'No vehicle details found for given vehicle ID with respect to driver ID.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($vehicledata);
			$finalvehicledata = array();
			$finalvehicledata['vehicle_id'] = $request['vehicleid'];
			$finalvehicledata['vehicle_name'] = $vehicledata->vehicle_name;
			$finalvehicledata['vehicle_colour'] = $vehicledata->vehicle_colour;
			$finalvehicledata['vehicle_number_plate'] = $vehicledata->vehicle_number_plate;
			$finalvehicledata['passanger_capacity'] = $vehicledata->passanger_capacity;
			$finalvehicledata['wheelchair_passanger_capacity'] = $vehicledata->wheelchair_passanger_capacity;
			$finalvehicledata['child_seat_capacity'] = $vehicledata->child_seat_capacity;
			$finalvehicledata['child_booster_capacity'] = $vehicledata->child_booster_capacity;
			$finalvehicledata['large_luggage_capacity'] = $vehicledata->large_luggage_capacity;
			$finalvehicledata['small_luggage_capacity'] = $vehicledata->small_luggage_capacity;
			$finalvehicledata['vehicle_status'] = ($vehicledata->vehicle_status == '1') ? 'Active' : 'Inactive';
			$finalvehicledata['vehicle_image'] = $vehicledata->vehicle_image;
			
			$finalvehicledata['OtherImages'] = array();
			if(!empty($vehicledata->Vehicleimages) && count($vehicledata->Vehicleimages) > 0){
				foreach($vehicledata->Vehicleimages as $individualimage){
					$singleimage =  array();
					$singleimage['vehicle_imageid'] = $individualimage['id'];
					$singleimage['vehicle_image'] = URL::asset('images/vehicles').'/'.$vehicledata->id.'/'.$individualimage['vehicle_image_name'];
					array_push($finalvehicledata['OtherImages'],$singleimage);
				}
			}
			
			$returnarray['msg'] = 'Vehicle details fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['vehicledata'] = $finalvehicledata;		
		}
		return $returnarray;
    }
	
	/**
     * Delete Vehicle.
     *
     * @return Vehicle delete status
     */
    public function deleteVehicle($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'vehicleid' => 'required|numeric',
			'driverid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		if(DriverVehicles::where('driver_id','=',$request['driverid'])->where('id','=',$request['vehicleid'])->delete()){
			VehicleImages::where('vehicle_id','=',$request['vehicleid'])->delete();
			/*$dir = public_path().'/images/vehicles/'.$request['vehicleid'];
			foreach (glob($dir."/*.*") as $filename) {
				if (is_file($filename)) {
					unlink($filename);
				}
			}
			rmdir($dir);*/

			$returnarray['msg'] = 'Vehicle deleted successfully';
			$returnarray['status'] = 1;	
		}
		else{
			$returnarray['errormsg'] = 'Some problem occured to delete the vehicle. Invalid driver OR vehicle ID.';
			$returnarray['status'] = 0;
		}
		return $returnarray;
    }
	
	/**
     * Get Job with all it's Details for Driver.
     *
     * @return Job Details
     */
    public function getPostedJobDetail($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'jobid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$booking = Jobs::with('Riderdetails','Jobdetails','Jobbetweenlocations')->where('id','=',$request['jobid'])->first();
		if(empty($booking) || count($booking) == 0){
			$returnarray['errormsg'] = 'No details found for this Job.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($booking);
			$finaljobarray = array();
			$individualjob = array();
			$individualjob['Id'] = $booking->id;
			$individualjob['JobId'] = $booking->job_id;
			$individualjob['JobDateTime'] = strtoupper(date("j M Y, g:i:s a", strtotime($booking->job_date_time)));
			$individualjob['JobType'] = ($booking->job_type == 1) ? 'Job Now' : 'Job Later';
			$individualjob['EstimatedDistance'] = $booking->estimated_distance." MILES";
			$individualjob['EstimatedJourneyTime'] = $booking->estimated_journey_time." MINS";
			$individualjob['Passanger'] = $booking->Jobdetails->no_of_passenger;
			$individualjob['WheelchairPassanger'] = $booking->Jobdetails->wheelchair_passenger;
			$individualjob['Child'] = $booking->Jobdetails->no_of_childseats;
			$individualjob['ChildBooster'] = $booking->Jobdetails->no_of_childbooster;
			$individualjob['LargeLuggage'] = $booking->Jobdetails->no_of_large_luggage;
			$individualjob['SmallLuggage'] = $booking->Jobdetails->no_of_small_luggage;
			$individualjob['SpecialRequirement'] = $booking->Jobdetails->special_requirement;
			if(!empty($booking->Riderdetails) && count($booking->Riderdetails) > 0){
				$individualjob['RiderName'] = $booking->Riderdetails['name'];
				$individualjob['RiderAvatar'] = (!empty($booking->Riderdetails['Riderimages']) && count($booking->Riderdetails['Riderimages']) > 0 && $booking->Riderdetails['Riderimages']['avatar_image'] != NULL) ? $booking->Riderdetails['Riderimages']['avatar_image'] : "Not Available Yet";
				$individualjob['RiderRating'] = $booking->Riderdetails['rider_avg_rating'];
			}
			$individualjob['BetweenList'] = array();
			foreach($booking->Jobbetweenlocations as $location){
				$locationarray = array();
				$locationarray['VisitId'] = $location['ride_location_sequence'];
				$locationarray['Address'] = $location['location_address'];
				$locationarray['Lat'] = $location['location_latitude'];
				$locationarray['Long'] = $location['location_longitude'];
				
				if($location['location_type'] == 1){
					$individualjob['Source'] = $locationarray;
				}
				elseif($location['location_type'] == 2){
					$individualjob['Destination'] = $locationarray;
				}
				else{
					array_push($individualjob['BetweenList'],$locationarray);
				}
			}
			if(count($individualjob['BetweenList']) == 0){ unset($individualjob['BetweenList']); }
			array_push($finaljobarray,$individualjob);
						
			$returnarray['msg'] = 'Jobs Details fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['JobInformation'] = $finaljobarray;	
		}
		return $returnarray;
    }
	
	/**
     * Apply Bid For Published Job.
     *
     * @return Apply bid status
     */
    public function submitBidForJob($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
			'jobid' => 'required|numeric',
			'vehicleid' => 'required|numeric',
			'bidamount' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$jobdata = JobBids::where('job_id','=',$request['jobid'])->where('driver_id','=',$request['driverid'])->first();
		if(!empty($jobdata) && count($jobdata) > 0){
			$returnarray['errormsg'] = 'You have already applied for this JOB.';
			$returnarray['status'] = 0;
		}
		else{
			$driverdata = Drivers::select('driver_current_car')->where('id',$request['driverid'])->first();
			$bidinfo = array();
			$bidinfo['driver_id'] = $request['driverid'];
			$bidinfo['job_id'] = $request['jobid'];
			$bidinfo['vehicle_id'] = (isset($request['vehicleid']) && $request['vehicleid'] != NULL) ? $request['vehicleid'] : $driverdata->driver_current_car;
			$bidinfo['bid_amount'] = $request['bidamount'];
			$bidinfo['bid_type'] = 1;
			
			if($submitbid = JobBids::create($bidinfo)){
				$returnarray['msg'] = 'Bid submit successfully to given Job';
				$returnarray['status'] = 1;
				$returnarray['BidID'] = $submitbid->id;	
			}
			else{
				$returnarray['errormsg'] = 'Problem occured to submit bid. Please try after some time.';
				$returnarray['status'] = 0;
			}
		}
		return $returnarray;
    }
	
	/**
     * Apply Bid For Published Job.
     *
     * @return Apply bid status
     */
    public function getAllAppliedBids($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$biddata = JobBids::has('TodayAndLaterJob')->with('Jobdetails')->where('driver_id','=',$request['driverid'])->orderBy('updated_at','DESC')->limit(50)->get();
		if(empty($biddata) || count($biddata) == 0){
			$returnarray['errormsg'] = 'No Bids found for given Driver.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($biddata);
			$returnarray['msg'] = 'Bid details fetch successfully.';
			$returnarray['status'] = 1;
			$finalbiddata = array();
			
			foreach($biddata as $bid){
				$bidinfo = array();
				$bidinfo['MainJobID'] = $bid['Jobdetails']['id'];
				$bidinfo['JobID'] = $bid['Jobdetails']['job_id'];
				$bidinfo['BidAmount'] = $bid['bid_amount'];
				$bidinfo['EstimatedDistance'] = $bid['Jobdetails']['estimated_distance']." MILES";
				$bidinfo['EstimatedTime'] = $bid['Jobdetails']['estimated_journey_time']." MINS";
				//$jobdate = date('Y-m-d',strtotime())
				$bidinfo['JobTime'] = ($bid['Jobdetails']['job_type'] == 1)? "Cab Now" : "Scheduled at ".strtoupper(date("j M Y", strtotime($bid['Jobdetails']['job_date_time'])));
				array_push($finalbiddata, $bidinfo);
			}
			$returnarray['BidData'] = $finalbiddata;
				
		}
		return $returnarray;
    }
	
	/**
     * Get Job with all it's Details for Driver.
     *
     * @return Job Details
     */
    public function submittedBidJobDetail($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'bidid' => 'required',
        ]);
		
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$biddata = JobBids::with('Jobdetails','Cabdetails')->find($request['bidid']);
		if(empty($biddata) || count($biddata) == 0){
			$returnarray['errormsg'] = 'No details found for given BidID.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($biddata);
			$finaljobarray = array();
			$individualjob = array();
			$individualjob['Id'] = $biddata->Jobdetails->id;
			$individualjob['JobId'] = $biddata->Jobdetails->job_id;
			$individualjob['JobDateTime'] = strtoupper(date("j M Y, g:i:s a", strtotime($biddata->Jobdetails->job_date_time)));
			$individualjob['JobType'] = ($biddata->Jobdetails->job_type == 1) ? 'Job Now' : 'Job Later';
			$individualjob['EstimatedDistance'] = $biddata->Jobdetails->estimated_distance." MILES";
			$individualjob['EstimatedJourneyTime'] = $biddata->Jobdetails->estimated_journey_time." MINS";
			$individualjob['VehicleName'] = $biddata->Cabdetails->vehicle_name;
			$individualjob['VehicleImage'] = (!empty($biddata->Cabdetails->vehicle_image) && $biddata->Cabdetails->vehicle_image != NULL) ? URL::asset('images/vehicles').'/'.$biddata->Cabdetails->id.'/'.$biddata->Cabdetails->vehicle_image : "Not Available Yet";;
			$individualjob['VehicleNumberPlate'] = $biddata->Cabdetails->vehicle_number_plate;
			$individualjob['BidAmount'] = $biddata->bid_amount;
			$individualjob['Passanger'] = $biddata->Jobdetails->Jobdetails->no_of_passenger;
			$individualjob['WheelchairPassanger'] = $biddata->Jobdetails->Jobdetails->wheelchair_passenger;
			$individualjob['Child'] = $biddata->Jobdetails->Jobdetails->no_of_childseats;
			$individualjob['ChildBooster'] = $biddata->Jobdetails->Jobdetails->no_of_childbooster;
			$individualjob['LargeLuggage'] = $biddata->Jobdetails->Jobdetails->no_of_large_luggage;
			$individualjob['SmallLuggage'] = $biddata->Jobdetails->Jobdetails->no_of_small_luggage;
			$individualjob['SpecialRequirement'] = $biddata->Jobdetails->Jobdetails->special_requirement;
			if(!empty($biddata->Jobdetails->Riderdetails) && count($biddata->Jobdetails->Riderdetails) > 0){
				$individualjob['RiderName'] = $biddata->Jobdetails->Riderdetails->name;
				$individualjob['BusinessCustomer'] = ($biddata->Jobdetails->Riderdetails->business_customer == 1)? "Yes" : "No";
				$individualjob['RiderAvatar'] = (count($biddata->Jobdetails->Riderdetails->Riderimages) > 0 && $biddata->Jobdetails->Riderdetails->Riderimages->avatar_image != NULL) ? $biddata->Jobdetails->Riderdetails->Riderimages->avatar_image : "Not Available Yet";
				$individualjob['RiderRating'] = $biddata->Jobdetails->Riderdetails->rider_avg_rating;
			}
			$individualjob['BetweenList'] = array();
			foreach($biddata->Jobdetails->Jobbetweenlocations as $location){
				$locationarray = array();
				$locationarray['VisitId'] = $location['ride_location_sequence'];
				$locationarray['Address'] = $location['location_address'];
				$locationarray['Lat'] = $location['location_latitude'];
				$locationarray['Long'] = $location['location_longitude'];
				
				if($location['location_type'] == 1){
					$individualjob['Source'] = $locationarray;
				}
				elseif($location['location_type'] == 2){
					$individualjob['Destination'] = $locationarray;
				}
				else{
					array_push($individualjob['BetweenList'],$locationarray);
				}
			}
			if(count($individualjob['BetweenList']) == 0){ unset($individualjob['BetweenList']); }
			array_push($finaljobarray,$individualjob);
						
			$returnarray['msg'] = 'Jobs Details fetched successfully';
			$returnarray['status'] = 1;
			$returnarray['JobInformation'] = $finaljobarray;	
		}
		return $returnarray;
    }
	
	/**
     * Apply Bid For Published Job.
     *
     * @return Apply bid status
     */
    public function myBookingForDriver($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$biddata = JobBids::has('TodayAndLaterJob')->with('Jobdetails','Cabdetails')->where('driver_id','=',$request['driverid'])->where('job_bids_status','=','2')->orderBy('created_at','DESC')->limit(50)->get();
		if(empty($biddata) || count($biddata) == 0){
			$returnarray['errormsg'] = 'No Booking found for given Driver.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($biddata);
			$returnarray['msg'] = 'Booking details fetch successfully.';
			$returnarray['status'] = 1;
			$finalbiddata = array();
			
			foreach($biddata as $bid){
				$bidinfo = array();
				$bidinfo['MainJobID'] = $bid['Jobdetails']['id'];
				$bidinfo['JobID'] = $bid['Jobdetails']['job_id'];
				$bidinfo['JobDate'] = strtoupper(date("j M Y, g:i:s a", strtotime($bid['Jobdetails']['job_date_time'])));
				$bidinfo['BidAmount'] = $bid['bid_amount'];
				$bidinfo['EstimatedDistance'] = $bid['Jobdetails']['estimated_distance']." MILES";
				$bidinfo['EstimatedTime'] = $bid['Jobdetails']['estimated_journey_time']." MINS";
				$bidinfo['VehicleName'] = $bid['Cabdetails']['vehicle_name'];
				$bidinfo['VehicleImage'] = (!empty($bid['Cabdetails']['vehicle_image']) && $bid['Cabdetails']['vehicle_image'] != NULL) ? URL::asset('images/vehicles').'/'.$bid['Cabdetails']['id'].'/'.$bid['Cabdetails']['vehicle_image'] : "Not Available Yet";
				$bidinfo['VehicleNumberPlate'] = $bid['Cabdetails']['vehicle_number_plate'];
				
				if(!empty($bid['Jobdetails']['Riderdetails']) && count($bid['Jobdetails']['Riderdetails']) > 0){
					$bidinfo['RiderName'] = $bid['Jobdetails']['Riderdetails']->name;
					$bidinfo['BusinessCustomer'] = ($bid['Jobdetails']['Riderdetails']['business_customer'] == 1)? "Yes" : "No";
					$bidinfo['RiderAvatar'] = (!empty($bid['Jobdetails']['Riderdetails']['rider_avatar']) && $bid['Jobdetails']['Riderdetails']['rider_avatar'] != NULL) ? URL::asset('images/riders').'/'.$bid['Jobdetails']['Riderdetails']['id'].'/'.$bid['Jobdetails']['Riderdetails']['rider_avatar'] : "Not Available Yet";
					$bidinfo['RiderRating'] = $bid['Jobdetails']['Riderdetails']['rider_avg_rating'];
				}
				
				$bidinfo['BetweenList'] = array();
				foreach($bid['Jobdetails']['Jobbetweenlocations'] as $location){
					$locationarray = array();
					$locationarray['VisitId'] = $location['ride_location_sequence'];
					$locationarray['Address'] = $location['location_address'];
					$locationarray['Lat'] = $location['location_latitude'];
					$locationarray['Long'] = $location['location_longitude'];
					
					if($location['location_type'] == 1){
						$bidinfo['Source'] = $locationarray;
					}
					elseif($location['location_type'] == 2){
						$bidinfo['Destination'] = $locationarray;
					}
					else{
						array_push($bidinfo['BetweenList'],$locationarray);
					}
				}
				if(count($bidinfo['BetweenList']) == 0){ unset($bidinfo['BetweenList']); }
				
				array_push($finalbiddata, $bidinfo);
			}
			$returnarray['BookingData'] = $finalbiddata;		
		}
		return $returnarray;
    }
	
	/**
     * Accpet OR Decline the Requestd Job by Rider.
     *
     * @return Accept OR Reject Status
     */
    public function processRequestedJob($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'driverid' => 'required|numeric',
			'jobid' => 'required|numeric',
			'jobreply' => 'required',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$biddata = JobBids::where('driver_id','=',$request['driverid'])->where('job_id','=',$request['jobid'])->first();
		if(empty($biddata) || count($biddata) == 0){
			$returnarray['errormsg'] = 'No Bids found for given Driver.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($biddata);
			$biddata->job_bids_status = ($request['jobreply'] == "Accept") ? '2' : '3';
			if($biddata->update()){
					$jobdata = Jobs::find($request['jobid']);
					if($request['jobreply'] == "Accept"){
						$joblocation = JobLocations::where('job_id','=',$request['jobid'])->where('location_type','=','1')->first();
						$joblocation->location_status = '1';
						$joblocation->update();
						$jobdata->job_status = 4;
						$processmsg = 'Job accepted successfully.';
					}
					else{
						$jobdata->job_status = 2;
						$processmsg = 'Job rejected successfully.';
					}
					
					if($jobdata->update()){
						$returnarray['msg'] = $processmsg;
					}
					else{
						$returnarray['msg'] = 'Problem occured to update job status. Try after some time.';
					}
				$returnarray['JobID'] = $request['jobid'];
				$returnarray['status'] = 1;
			}
			else{
				$returnarray['msg'] = 'Problem occured to process job request. Try after some time.';
				$returnarray['status'] = 1;
			}
				
		}
		return $returnarray;
    }
	
	/**
     * Start Job Trip By Driver.
     *
     * @return Start Job Status
     */
    public function startJobTrip($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			//'driverid' => 'required|numeric',
			'jobid' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$jobdata = Jobs::find($request['jobid']);
		if(empty($jobdata) || count($jobdata) == 0){
			$returnarray['errormsg'] = 'No Jobs found given ID.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($biddata);
			$jobdata->job_status = 5;
			if($jobdata->update()){
				$joblocation = JobLocations::where('job_id','=',$request['jobid'])->where('location_type','=','1')->first();
				$joblocation->location_status = '3';
				if($joblocation->update()){
					JobLocations::where('job_id','=',$request['jobid'])->where('ride_location_sequence','=','2')->update(['location_status' => '1']);
				}
				$returnarray['msg'] = 'Job started successfully.';
				$returnarray['JobID'] = $request['jobid'];
				$returnarray['status'] = 1;
			}
			else{
				$returnarray['msg'] = 'Problem occured to process job request. Try after some time.';
				$returnarray['status'] = 1;
			}
		}
		return $returnarray;
    }
	
	/**
     * Complete Job Trip By Driver.
     *
     * @return Job Complete Status
     */
    public function completeJobTrip($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			//'driverid' => 'required|numeric',
			'jobid' => 'required|numeric',
			'triplocation' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$jobdata = Jobs::find($request['jobid']);
		if(empty($jobdata) || count($jobdata) == 0){
			$returnarray['errormsg'] = 'No Jobs found given ID.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($biddata);
			$jobdata->job_status = 6;
			if($jobdata->update()){
				$joblocation = JobLocations::where('job_id','=',$request['jobid'])->where('ride_location_sequence','=',$request['triplocation'])->first();
				$joblocation->location_status = '4';
				$joblocation->update();
				JobLocations::where('job_id','=',$request['jobid'])->where('ride_location_sequence','>',$request['triplocation'])->update(['location_status' => '2']);
				$returnarray['msg'] = 'Job completed successfully.';
				$returnarray['JobID'] = $request['jobid'];
				$returnarray['status'] = 1;
			}
			else{
				$returnarray['msg'] = 'Problem occured to change job status to completed. Try again.';
				$returnarray['status'] = 1;
			}
				
		}
		return $returnarray;
    }
	
	/**
     * Keep update the Trip route locations.
     *
     * @return Location Status
     */
	public function updateTripLocation($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'jobid' => 'required|numeric',
			'triplocation' => 'required|numeric',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		$jobdata = Jobs::find($request['jobid']);
		if(empty($jobdata) || count($jobdata) == 0){
			$returnarray['errormsg'] = 'No Jobs found given ID.';
			$returnarray['status'] = 0;
		}
		else{
			//dd($biddata);
			if(JobLocations::where('job_id','=',$request['jobid'])->where('ride_location_sequence','=',$request['triplocation'])->update(['location_status' => '3']) && JobLocations::where('job_id','=',$request['jobid'])->where('ride_location_sequence','=',($request['triplocation'] + 1))->update(['location_status' => '1'])){
				$returnarray['msg'] = 'Trip location updated successfully.';
				$returnarray['JobID'] = $request['jobid'];
				$returnarray['status'] = 1;
			}
			else{
				$returnarray['msg'] = 'Problem occured to update trip location status. Try again.';
				$returnarray['status'] = 1;
			}		
		}
		return $returnarray;
	}
	
	/**
     * Give Rating To Rider After Job Completion.
     *
     * @return Rating and Comment submit Status
     */
    public function paymentRegisterAndRiderRating($request){
		//dd($request); 
		$validator = Validator::make($request, [           
			'jobid' => 'required|numeric',
			'rating' => 'required',
			'paymenttype' => 'required',
        ]);
        if($validator->fails()) {
			return [
				'status' => 0,
				'errormsg' => $validator->errors()
			];
		}
		
		$jobdata = Jobs::with('ConfirmedBid')->find($request['jobid']);
		if(empty($jobdata) || count($jobdata) == 0){
			$returnarray['errormsg'] = 'No Job found for given ID. Invalid Job.';
			$returnarray['status'] = 0;
		}
		else{
			
			$paymentdata = array();
			$paymentdata['job_id'] = $request['jobid'];
			$paymentdata['rider_id'] = $jobdata->rider_id;
			$paymentdata['driver_id'] = $jobdata->ConfirmedBid->driver_id;
			$paymentdata['payment_amount'] = $jobdata->ConfirmedBid->bid_amount;
			$paymentdata['payment_type'] = ($request['paymenttype'] == "Card")? 2 : 1;
			$paymentdata['payment_status'] = '1';
			
			if(JobPayments::create($paymentdata)){
				$jobratingdata = JobRatings::where('job_id','=',$request['jobid'])->first();	
				if(empty($jobratingdata) || count($jobratingdata) == 0){
					$ratingArray = array();
					$ratingArray['job_id'] = $request['jobid'];
					$ratingArray['rider_id'] = $jobdata->rider_id;
					$ratingArray['rider_rating'] = $request['rating'];
					$ratingArray['rider_experience_comment'] = (isset($request['comment']) && $request['comment'] != "" && $request['comment'] != NULL) ? $request['comment'] : "";
					
					if(JobRatings::create($ratingArray)){
						$averageriderrating = JobRatings::where('rider_id','=',$jobdata->rider_id)->avg('rider_rating');
						$riderdata = Riders::find($jobdata->rider_id);
						$riderdata->rider_avg_rating = round($averageriderrating,2);
						if($riderdata->update()){
							$returnarray['msg'] = 'Rating for rider and payment details submitted successfully';
							$returnarray['status'] = 1;
							$returnarray['jobid'] = $request['jobid'];
						}
						else{
							$returnarray['msg'] = 'Problem occured to submit the payment details. Please try after some time.';
							$returnarray['status'] = 0;
						}
						
					}
					else{
						$returnarray['errormsg'] = 'Problem occured to submit the rating for rider. Please try after some time.';
						$returnarray['status'] = 0;
					}
				}
				else{
					$jobratingdata->rider_id = $jobdata->rider_id;
					$jobratingdata->rider_rating = $request['rating'];
					$jobratingdata->rider_experience_comment = (isset($request['comment']) && $request['comment'] != "" && $request['comment'] != NULL) ? $request['comment'] : "";
					
					if($jobratingdata->update()){
						$averageriderrating = JobRatings::where('rider_id','=',$jobdata->rider_id)->avg('rider_rating');
						$riderdata = Riders::find($jobdata->rider_id);
						$riderdata->rider_avg_rating = round($averageriderrating,2);
						
						if($riderdata->update()){
							$returnarray['msg'] = 'Rating for rider and payment details submitted successfully';
							$returnarray['status'] = 1;
							$returnarray['jobid'] = $request['jobid'];
						}
						else{
							$returnarray['msg'] = 'Problem occured to submit the payment details. Please try after some time.';
							$returnarray['status'] = 0;
						}
					}
					else{
						$returnarray['msg'] = 'Problem occured to submit the rider rating. Please try after some time.';
						$returnarray['status'] = 0;
					}		
				}
			}
			else{
				$returnarray['msg'] = 'Problem occured to submit the payment details. Please try after some time.';
				$returnarray['status'] = 0;
			}
		}
		
		return $returnarray;
    }
	
}

