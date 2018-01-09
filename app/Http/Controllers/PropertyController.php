<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\State;
use App\Property;
use App\Amenities;
use App\Features;
use App\Contact;
use App\Mail\PropertyInquiry;
use Validator;
use Session;
use DB;
use Mail;
use File;
use View;
use URL;

class PropertyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		parent::__construct();
		$this->messages = [
			'required' => 'The :attribute is required.',
			'unique' => 'The :attribute has already been assign to other Property.',
			'state_id.required' => 'Please select state.',
			//'employee_email.unique' => 'The :attribute has already been assign to other employee.',
		];
    }

    /**
     * Show the Our Community Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$statecitydata = State::with('Propertydata.Propertycity')->where('state_status','=','1')->orderBy('state_name', 'asc')->get();
		//dd($statecitydata);
        return view('property.community')->with(compact('statecitydata'));
    }
	
	/**
     * Listing Property.
     *
     * @return \Illuminate\Http\Response
     */
    public function propertylisting($state)
    {
		//dd($state);
		$statepropertydata = State::with('Propertydata.Propertycity')->where('state_status','=','1')->where('state_name','=',trim($state))->first();
		//dd($statepropertydata);
		if($statepropertydata == NULL || empty($statepropertydata)){
			return redirect('/our_community');
		}
		
		$propertydetailarray = array();
		$propertyinfocontent = array();
		if($statepropertydata->Propertydata != '' && count($statepropertydata->Propertydata) > 0){
			foreach($statepropertydata->Propertydata as $k=>$value){
				//dd($statepropertydata->Propertydata);
				$propertydetailarray[] = $value->property_address.' '.$value->Propertycity->city_name.' '.$statepropertydata->state_name.' '.$value->property_postalcode;
				$propertyinfocontent[] =  '<div style="font-size:12px;background-color:white;line-height:1.35;overflow:hidden;white-space:nowrap;"><strong>'.$value->property_name.'</strong><br />'.$value->property_address.'<br />'.$value->Propertycity->city_name.', '.$statepropertydata->state_abbr.' '.$value->property_postalcode.'<br/><a href="http://www.elmwood-apts.com">click here for more info</a></div>';
			}
		}
		$finalcontentinfo = json_encode($propertyinfocontent);
		//dd($propertydetailarray);
        return view('property.propertylisting')->with(compact('statepropertydata','state','propertydetailarray','propertyinfocontent','finalcontentinfo'));
    }
	
	/**
     * Property Detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function propertydetail($propertyurl)
    {
		//dd($propertyurl);
		$propertydata = Property::with('Propertycity','Propertystate','Propertyimagedata','Propertyroomsdata')->where('property_status','=','1')->where('property_seourl','=',trim($propertyurl))->first();
		//dd($propertydata);
		if($propertydata == NULL || empty($propertydata)){
			return redirect('/');
		}
		
		$featureids = explode(',', trim($propertydata->property_features,'[]'));
		$featuredata = Features::whereIn('feature_id',$featureids)->get();
		//dd($featuredata);
		$amenitiesids = explode(',', trim($propertydata->property_amenities,'[]'));
		$amenitiesdata = Amenities::whereIn('amenity_id',$amenitiesids)->get();
		//dd($amenitiesdata);
		$propertydocument = ($propertydata->property_document != '' && $propertydata->property_document != NULL) ? URL::to('/').'/images/property/'.$propertydata->property_id.'/'.$propertydata->property_document : '#';
		$propertyaddress = $propertydata->property_address.' '.$propertydata->Propertycity->city_name.' '.$propertydata->Propertystate->state_abbr.' '.$propertydata->property_postalcode;
		$propertyinfocontent =  '<div style="font-size:12px;background-color:white;line-height:1.35;overflow:hidden;white-space:nowrap;"><strong>'.$propertydata->property_name.'</strong><br />'.$propertydata->property_address.'<br />'.$propertydata->Propertycity->city_name.', '.$propertydata->Propertystate->state_abbr.' '.$propertydata->property_postalcode.'<br/><a href="http://www.elmwood-apts.com">click here for more info</a></div>';
		$propertyhours = unserialize($propertydata->property_officehours);
		//dd($propertyhours);
		
		$hourscount = 0;
		if(!empty($propertyhours) && count($propertyhours) > 0){
			foreach($propertyhours as $day=>$daydetails){
				//dd($daydetails);
				if(isset($daydetails['hours']) || isset($daydetails['close'])){
					if(isset($daydetails['close']) && $daydetails['close'] == true){
						$hourscount++;
					}
					elseif(isset($daydetails['hours']) && $daydetails['hours'] != "" && $daydetails['hours'] != NULL){
						$hourscount++;
					}
				}
			}
		}
		
		if($propertydata->property_metatitle != '' && $propertydata->property_metatitle != NULL){
			View::share('meta_title', $propertydata->property_metatitle);
		}
		if($propertydata->property_metakeywords != '' && $propertydata->property_metakeywords != NULL){
			View::share('meta_keywords', $propertydata->property_metakeywords);
		}
		if($propertydata->property_metadesc != '' && $propertydata->property_metadesc){
			View::share('meta_desc', $propertydata->property_metadesc);
		}
			
		//dd($hourscount);
        
		return view('property.propertydetails')->with(compact('propertydata','featuredata','amenitiesdata','propertydocument','propertyinfocontent','propertyaddress','propertyinfocontent','propertyhours','hourscount'));
    }
	
	/**
     * Property Contact Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPropertycontact($propertyurl)
    {
		//dd($propertyurl);
		$propertydata = Property::with('Propertycity','Propertystate')->where('property_status','=','1')->where('property_seourl','=',trim($propertyurl))->first();
		//dd($propertydata);
		if($propertydata == NULL || empty($propertydata)){
			return redirect('/');
		}
		
		if($propertydata->property_metatitle != '' && $propertydata->property_metatitle != NULL){
			View::share('meta_title', $propertydata->property_metatitle);
		}
		if($propertydata->property_metakeywords != '' && $propertydata->property_metakeywords != NULL){
			View::share('meta_keywords', $propertydata->property_metakeywords);
		}
		if($propertydata->property_metadesc != '' && $propertydata->property_metadesc){
			View::share('meta_desc', $propertydata->property_metadesc);
		}
		
		$propertyaddress = $propertydata->property_address.' '.$propertydata->Propertycity->city_name.' '.$propertydata->Propertystate->state_abbr.' '.$propertydata->property_postalcode;
		return view('property.propertycontact')->with(compact('propertydata','propertyaddress'));
	}
	
	/**
     * Property Contact Form Send.
     *
     * @return \Illuminate\Http\Response
     */
    public function propertycontact(Request $request, $propertyurl)
    {
		//dd($request->all());
		$validator = Validator::make($request->all(), [           
			'contact_name' => 'required',
			'contact_email' => 'required|email',
			'contact_phone' => 'regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/',
        ],$this->messages);
		
        if ($validator->fails()) {
			//dd($validator);
            $this->throwValidationException(
                $request, $validator
            );
		}
			
		$input = $request->all();
		//dd($propertyurl);
		
		$propertydata = Property::where('property_status','=','1')->where('property_seourl','=',trim($propertyurl))->first();
		if($propertydata == NULL || empty($propertydata)){
			return redirect('/');
		}
		
		$input['contact_receivedfrom'] = 'property';
		$input['contact_reference_property'] = $propertydata->property_id;
		//dd($input);
		
		if($contactdetails = Contact::create($input))
		{
			Mail::to('ilyas.balluwala@gryphontechnolabs.co.in')->send(new PropertyInquiry($contactdetails, $propertydata->property_name));
			$request->session()->flash('alert-success', 'Thank you for your Inquiry for this property. We will reach you shortly.');
		}
		return redirect('/property/contact/'.$propertyurl) ;
	}
	
	/**
     * Property Gallary.
     *
     * @return \Illuminate\Http\Response
     */
    public function propertygallary($propertyurl)
    {
		//dd($propertyurl);
		$propertydata = Property::with('Propertycity','Propertyimagedata')->where('property_status','=','1')->where('property_seourl','=',trim($propertyurl))->first();
		//dd($propertydata);
		if($propertydata == NULL || empty($propertydata)){
			return redirect('/');
		}
        
		if($propertydata->property_metatitle != '' && $propertydata->property_metatitle != NULL){
			View::share('meta_title', $propertydata->property_metatitle);
		}
		if($propertydata->property_metakeywords != '' && $propertydata->property_metakeywords != NULL){
			View::share('meta_keywords', $propertydata->property_metakeywords);
		}
		if($propertydata->property_metadesc != '' && $propertydata->property_metadesc){
			View::share('meta_desc', $propertydata->property_metadesc);
		}
			
		return view('property.propertygallary')->with(compact('propertydata'));
    }
}
