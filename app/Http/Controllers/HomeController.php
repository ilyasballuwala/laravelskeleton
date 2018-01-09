<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\SliderImages;
use App\HomepageDetails;
use App\CMS;
use App\Property;
use App\Contact;
use App\State;
use App\Mail\ContactAdminInquiry;
use App\Mail\ContactUserInquiry;
use Validator;
use Session;
use DB;
use File;
use Mail;
use View;
use URL;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomepageDetails $homepagedetails)
    {
		parent::__construct();
    }

    /**
     * Show the Home Page dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$homepagefields = HomepageDetails::first();
		$homepageimages = SliderImages::get();
        //$this->middleware('auth');
		if($homepagefields->meta_title != '' && $homepagefields->meta_title != NULL){
			View::share('meta_title', $homepagefields->meta_title);
		}
		if($homepagefields->meta_keywords != '' && $homepagefields->meta_keywords != NULL){
			View::share('meta_keywords', $homepagefields->meta_keywords);
		}
		if($homepagefields->meta_desc != '' && $homepagefields->meta_desc != NULL){
			View::share('meta_desc', $homepagefields->meta_desc);
		}
        return view('home')->with(compact('homepageimages','homepagefields'));
    }
	
	/**
     * Show the CMS Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmspage($pageurl)
    {
		//dd($pageurl);
		$cmsdata = CMS::where('cms_page_url','=',$pageurl)->first();
		//dd($cmsdata);
		if($cmsdata == NULL || empty($cmsdata)){
			return redirect('/');
		}
		if($cmsdata->cms_page_metatitle != '' && $cmsdata->cms_page_metatitle != NULL){
			View::share('meta_title', $cmsdata->cms_page_metatitle);
		}
		if($cmsdata->cms_page_metakeywords != '' && $cmsdata->cms_page_metakeywords != NULL){
			View::share('meta_keywords', $cmsdata->cms_page_metakeywords);
		}
		if($cmsdata->cms_page_metadesc != '' && $cmsdata->cms_page_metadesc){
			View::share('meta_desc', $cmsdata->cms_page_metadesc);
		}
        return view('cmspage')->with(compact('cmsdata'));
    }
	
	/**
     * Show the Contact Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEfficientcontact()
    {
        return view('contactpage');
    }
	
	/**
     * Property Contact Form Send.
     *
     * @return \Illuminate\Http\Response
     */
    public function efficientcontact(Request $request)
    {
		//dd($request->all());
		$validator = Validator::make($request->all(), [           
			'contact_name' => 'required',
			'contact_email' => 'required|email',
			'contact_phone' => 'regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/',
        ]);
		
        if ($validator->fails()) {
			//dd($validator);
            $this->throwValidationException(
                $request, $validator
            );
		}
			
		$input = $request->all(); 
		$input['contact_receivedfrom'] = 'website';
		$input['contact_reference_property'] = 0;
		//dd($input);
		
		if($contactdetails = Contact::create($input))
		{
			Mail::to('ilyas.balluwala@gryphontechnolabs.co.in')->send(new ContactAdminInquiry($contactdetails));
			Mail::to($contactdetails->contact_email)->send(new ContactUserInquiry($contactdetails));
			$request->session()->flash('alert-success', 'Thank you for your interest in Efficient Corporate. We will contact you shortly.');
		}
		return redirect('/contact') ;
	}
	
	/**
     * Find Property Zipcode.
     *
     * @return \Illuminate\Http\Response
     */
    public function findpropertyzipcode(Request $request)
    {		
		$input = $request->all(); 
		//dd($input);
		$propertydata = Property::with('Propertystate')->where('property_status','=','1')->where('property_postalcode','=',trim($input['property_zipcode']))->get();
		//dd($propertydata);
		if(empty($propertydata) || count($propertydata) == 0){
			$statedata = State::where('state_status','1')->get();
			$zipcode = $input['property_zipcode'];
			return view('notfoundzipcode')->with(compact('zipcode','statedata'));
		}
		elseif(!empty($propertydata) && count($propertydata) > 1){
			return redirect('/apartments/'.ucfirst($propertydata[0]->Propertystate->state_name).'/efficient_property_management') ;
		}
		else{
			return redirect('/property/'.$propertydata[0]->property_seourl) ;
		}
	}
}
