<?php
// Added Amit on 03-03-2017
// New controller for dashboard page of admin

namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\admin\Controller;
use Illuminate\Http\Request;
use App\SliderImages;
use App\HomepageDetails;
use App\Contact;
use Validator;
use Session;
use DB;
use File;
use View;
use URL;

class DashboardController extends Controller {
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('admin');
		$this->messages = [
			'required' => 'The :attribute is required.',
			'unique' => 'The :attribute has already been assign to other Property.',
			'banner_image.*.image' => 'Banner images should be valid image',
		];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		
		$total_states = DB::table('state')->where('state_status','=','1')->count();
		$total_city = DB::table('city')->where('city_status','=','1')->count();
		$total_properties = DB::table('property')->where('property_status','=','1')->count();
		
		return view('admin.dashboard',array('title' => 'Dashboard','total_states' => $total_states,'total_city' => $total_city,'total_properties' => $total_properties));
    }
	
	/**
     * Show the home page fields.
     *
     * @return \Illuminate\Http\Response
     */
    public function homepagefields() {
		
		$homepagefields = HomepageDetails::first();
		$homepageimages = SliderImages::get();
		
		return view('admin.homepagefields',array('title' => 'Manage Home Page Content', 'homepagefields' => $homepagefields, 'homepageimages' => $homepageimages));
    }
	
	/**
     * Update Home Page Contents.
     *
     * @return \Illuminate\Http\Response
     */
    public function postHomepagefields(Request $request){
		//dd($request->all());
		
		$validator = Validator::make($request->all(), [           
			'banner_title' => 'required',
			'main_title' => 'required',
			'main_content' => 'required',
			'sidebar_image' => 'image',
			'meta_title' => 'required',
			'meta_keywords' => 'required',
			'meta_desc' => 'required',
        ],$this->messages);
		
        if ($validator->fails()) {
			//dd($validator);
            $this->throwValidationException(
                $request, $validator
            );
		}
			
		$input = $request->all();

		//dd($input);
		$homedetails = HomepageDetails::first();
		$homedetails->banner_title = $input['banner_title'];
		$homedetails->main_title = $input['main_title'];
		$homedetails->main_content = $input['main_content'];
		$homedetails->meta_title = $input['meta_title'];
		$homedetails->meta_keywords = $input['meta_keywords'];
		$homedetails->meta_desc = $input['meta_desc'];
		if(isset($input['sidebar_image']) && !empty($input['sidebar_image'])){
			$imageName = 'sidebarimage.'.$request->sidebar_image->getClientOriginalExtension();
			$input['sidebar_image'] = trim($imageName);
			$homedetails->sidebar_image = $input['sidebar_image'];
		}
		
		if($homedetails->update($input))
		{
			if(isset($input['sidebar_image']) && !empty($input['sidebar_image'])){
				$path = public_path().'/images/homapageimages/';
				File::makeDirectory($path, $mode = 0777, true, true);
				$request->sidebar_image->move($path, $imageName);
			}
		}
		
		if(isset($input['banner_image']) && count($input['banner_image']) > 0){
			foreach($input['banner_image'] as $k=>$image){
				$rules = array('file' => 'image|dimensions:min_width=760,min_height=290');
				$validator = Validator::make(array('file'=> $image), $rules);
					if($validator->passes()){
						$propertyimagearray = array();
						//$propertyimagearray['property_id'] = $propertyid;	
						$bannerimageName = date('YmdHis').rand(0,9999).'.'.$image->getClientOriginalExtension();
						$propertyimagearray['image_name'] = $bannerimageName;
						$uploadpath = public_path().'/images/homapageimages/';
						if(SliderImages::create($propertyimagearray)){
							$image->move($uploadpath, $bannerimageName);
						}
					}
				}
		}
		
		$request->session()->flash('alert-success', 'Home page details saved successfully.');
		
		return redirect('/admin/dashboard/homepagefields') ;
    }
	
	/**
     * Delete banner image page.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteimage($table,$field,$id){
		$sliderimagedata = SliderImages::where('image_id','=',$id)->first();
		//dd($sliderimagedata);
		if(SliderImages::destroy($id)){
			$oldimage = $sliderimagedata->image_name;
			$path = public_path().'/images/homapageimages/';
			File::delete($path.'/'.$oldimage);
			Session::flash('alert-success', 'Banner Image deleted successfully.');
		}
		else{
			Session::flash('alert-danger', 'There are some problem occured in delete banner image');
		}
		return redirect('admin/dashboard/homepagefields');
    }
	
	/**
     * List Website Contact which is arrived from Inquiry.
     *
     * @return \Illuminate\Http\Response
     */
    public function websitecontact(){
		$title = 'Website Contact List';
		$contactdata = Contact::where('contact_receivedfrom','=','website')->get();
		//dd($contactdata);
		return view('admin.websitecontactlist')->with(compact('contactdata','title'));
    }
	
	/**
     * List Property Contact which is arrived from Inquiry.
     *
     * @return \Illuminate\Http\Response
     */
    public function propertycontact(){
		$title = 'Property Contact List';
		$contactdata = Contact::with('Propertydata')->where('contact_receivedfrom','=','property')->get();
		//dd($contactdata);
		return view('admin.propertycontactlist')->with(compact('contactdata','title'));
    }
}