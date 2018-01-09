<?php
// Added Amit on 07-03-2017
// New controller for community page of admin

namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Property;
use App\PropertyImages;
use App\PropertyRooms;
use App\State;
use App\City;
use App\Amenities;
use App\Features;
use Validator;
use Session;
use DB;
use File;
use View;
use URL;

class PropertyController extends Controller {
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Property $property) {
        $this->middleware('admin');
		$this->model = $property;
		$this->currentcontroller = Route::currentRouteName();
		//dd($this->currentcontroller);
		View::share('title',ucfirst($this->currentcontroller));
		$this->messages = [
			'required' => 'The :attribute is required.',
			'unique' => 'The :attribute has already been assign to other Property.',
			'state_id.required' => 'Please select state.',
			//'employee_email.unique' => 'The :attribute has already been assign to other employee.',
		];
		$this->generaltitle = "Property Management";
    }

    /**
     * Show the Property Listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$propertydata = Property::with('Propertystate','Propertycity')->get();
		$title = $this->generaltitle;
		//dd($propertydata);
		return view('admin.property.propertylisting')->with(compact('propertydata','title',''));
    }
	
	/**
     * Show the add Property page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		$title = $this->generaltitle;
		$arrStatedata = State::where('state_status','=','1')->orderBy('state_name', 'asc')->get();
		foreach($arrStatedata as $state)
		{
			$statedata[$state->state_id] = $state->state_name;
		}
		return view('admin.property.addproperty')->with(compact('title','statedata'));
    }
	
	/**
     * Add Property Page Action.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		//dd($request->all());
		$validator = Validator::make($request->all(), [           
			'property_name' => 'required',
			'property_location' => 'required',
			'property_desc' => 'required',
			'property_state' => 'required',
			'property_city' => 'required',
			'property_seourl' => 'required|unique:property',
			'property_email' => 'required|email',
			'property_mainimage' => 'required|image',
			'property_logoimage' => 'required|image',
        ],$this->messages);
		
        if ($validator->fails()) {
			//dd($validator);
            $this->throwValidationException(
                $request, $validator
            );
		}
			
		$input = $request->all();
		$input['property_city'] = trim($input['property_city'],'number:');
		$imageName = 'mainimage.'.$request->property_mainimage->getClientOriginalExtension();
		$input['property_mainimage'] = trim($imageName);
		$logoimageName = 'logoimage.'.$request->property_logoimage->getClientOriginalExtension();
		$input['property_logoimage'] = trim($logoimageName);
		$input['product_uniquekey'] = date('YmdHis');
		//dd($input);
		
		if($property = Property::create($input))
		{
			$path = public_path().'/images/property/'.$property->property_id;
			File::makeDirectory($path, $mode = 0777, true, true);
			$request->property_mainimage->move($path, $imageName);
			$request->property_logoimage->move($path, $logoimageName);
			$request->session()->flash('alert-success', 'Property created successfully. Please fill other information');
		}
		return redirect('/admin/property/'.$property->property_id.'/edit') ;
    }
	
	/**
     * Show the edit property page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($propertyid){
		//dd($propertyid);
		$title = $this->generaltitle;
		$propertydata = Property::with('Propertyroomsdata','Propertyimagedata')->find($propertyid);
		$arrStatedata = State::where('state_status','=','1')->orderBy('state_name', 'asc')->get();
		foreach($arrStatedata as $state)
		{
			$statedata[$state->state_id] = $state->state_name;
		}
		$finalrooms = array();
		foreach($propertydata->Propertyroomsdata as $k=>$propertyrooms){
			$finalrooms[$k]['studiocount'] = "$propertyrooms->studiooption_value";
			$finalrooms[$k]['studiooption'] = ($propertyrooms->studiooption_name != NULL) ? $propertyrooms->studiooption_name : "0";
			$finalrooms[$k]['bedroomcount'] = "$propertyrooms->bedroomoption_value";
			$finalrooms[$k]['bedroomoption'] = ($propertyrooms->bedroomoption_name != NULL) ? $propertyrooms->bedroomoption_name : "0";
			$finalrooms[$k]['bathcount'] = "$propertyrooms->bathoption_value";
			$finalrooms[$k]['start_price'] = $propertyrooms->price_startvalue;
			$finalrooms[$k]['end_price'] = $propertyrooms->price_endvalue;
		}
		$finalrooms = json_encode($finalrooms);
		$hoursdata = json_encode(unserialize($propertydata->property_officehours));
		$propertyimages = json_encode($propertydata->Propertyimagedata);
		$propertydocument = ($propertydata->property_document != '' && $propertydata->property_document != NULL) ? URL::to('/').'/images/property/'.$propertydata->property_id.'/'.$propertydata->property_document : '#';
		
		$amenitiesdata = Amenities::where('amenity_status','=','1')->get();
		$featuresdata = Features::where('feature_status','=','1')->get();
		//dd($amenitiesdata);
		//dd($propertydata);
		return view('admin.property.editproperty')->with(compact('propertyid','title','propertydata','statedata','finalrooms','hoursdata','amenitiesdata','featuresdata','propertyimages','propertydocument'));
    }
	
	/**
     * Get Cities Based On State.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcity(Request $request){
		$stateid = $request->input('stateid');
		$arrCitydata = City::where('state_id','=',$stateid)->get();
		$citydata = array();
		$i = 0;
		foreach($arrCitydata as $city)
		{
			$citydata[$i]['id'] = $city['city_id'];  
			$citydata[$i]['name'] = $city['city_name'];
			$i++;
		}
		return response()->json($citydata);
		exit();
    }
	
	/**
     * Update Property General Info.
     *
     * @return \Illuminate\Http\Response
     */
    public function savegeneralinfo(Request $request){
		$data = array();
		$data['status'] = 0;
		$data['msg'] = 'Error';
		
		$input = $request->all();
		$propertyid = $input['propertyid'];
		$address = $input['generalinfo']['property_address'];
		
		$propertydata = Property::find($propertyid);
		$propertydesc = str_replace("\n","<br />",$input['generalinfo']['property_desc']);
		//echo $propertydesc; die();
				
		if(empty($propertydata)){
			$data['msg'] = 'Invalid Property';
		}
		else{
			$propertydata->property_name = $input['generalinfo']['property_name'];
			$propertydata->property_location = $request['generalinfo']['property_location'];
			$propertydata->property_desc = $propertydesc;
			$propertydata->property_state = $request['generalinfo']['property_state'];
			$propertydata->property_city = $request['generalinfo']['property_city'];
			$propertydata->property_seourl = $request['generalinfo']['property_seourl'];
			$propertydata->property_email = $request['generalinfo']['property_email'];
			$propertydata->property_address = $request['generalinfo']['property_address'];
			$propertydata->property_postalcode = $request['generalinfo']['property_postalcode'];
			$propertydata->property_phoneno = $request['generalinfo']['property_phoneno'];
			$propertydata->property_status = trim($request['generalinfo']['property_status']);

			if($propertydata->update()){
				$data['status'] = 1;
				$data['msg'] = 'Property Saved';
			}
			else{
				$data['msg'] = 'Error in save property details';		
			}
		}
		
		return response()->json($data); 
		exit();
    }
	
	/**
     * Update Property Rooms Info.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveroomsinfo(Request $request){
		$data = array();
		$data['status'] = 0;
		$data['msg'] = 'Error';
		
		$input = $request->all();
		$propertyid = $input['propertyid'];
		$roomsinfo = $input['roomsinfo'];
		$hoursinfo = (isset($input['hoursinfo']) && $input['hoursinfo'] != NULL && !empty($input['hoursinfo'])) ? $input['hoursinfo'] : NULL;
		/*return response()->json($roomsinfo); 
		exit();*/
		
		$propertydata = Property::find($propertyid);
		
		if(empty($propertydata)){
			$data['msg'] = 'Invalid Property';
		}
		else{
			$roomsdata = PropertyRooms::where('property_id','=',$propertyid)->delete();
			foreach($roomsinfo as $room){
				$roomarray = array();
				$roomarray['studiooption_name'] = (trim($room['studiooption']) != "" && trim($room['studiooption']) != NULL) ? trim($room['studiooption']) : NULL;
				$roomarray['studiooption_value'] = (trim($room['studiocount']) != "" && trim($room['studiocount']) != NULL) ? trim($room['studiocount']) : 0;
				$roomarray['bedroomoption_name'] = (trim($room['bedroomoption']) != "" && trim($room['bedroomoption']) != NULL) ? trim($room['bedroomoption']) : NULL;
				$roomarray['bedroomoption_value'] = (trim($room['bedroomcount']) != "" && trim($room['bedroomcount']) != NULL) ? trim($room['bedroomcount']) : 0;
				$roomarray['bathoption_value'] = (trim($room['bathcount']) != "" && trim($room['bathcount']) != NULL) ? trim($room['bathcount']) : 0;
				$roomarray['price_startvalue'] = (trim($room['start_price']) != "" && trim($room['start_price']) != NULL) ? trim($room['start_price']) : 0;
				$roomarray['price_endvalue'] = (trim($room['end_price']) != "" && trim($room['end_price']) != NULL) ? trim($room['end_price']) : 0;
				$roomarray['property_id'] = trim($propertyid);
				PropertyRooms::create($roomarray);
			}
			
			$propertydata->property_officehours = serialize($hoursinfo);

			if($propertydata->update()){
				$data['status'] = 1;
				$data['msg'] = 'Property Data Saved';
			}
			else{
				$data['msg'] = 'Error in save property details';		
			}
		}
		return response()->json($data); 
		exit();
    }
	
	/**
     * Update Property Amenities Info.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveamenitiesinfo(Request $request){
		$data = array();
		$data['status'] = 0;
		$data['msg'] = 'Error';
		
		$input = $request->all();
		$propertyid = $input['propertyid'];
		$amenitiesinfo = $input['amenitiesinfo'];
		$featuresinfo = $input['featuresinfo'];
		/*return response()->json($roomsinfo); 
		exit();*/
		
		$propertydata = Property::find($propertyid);
		
		if(empty($propertydata)){
			$data['msg'] = 'Invalid Property';
		}
		else{
			$propertydata->property_amenities = json_encode($amenitiesinfo);
			$propertydata->property_features = json_encode($featuresinfo);
			if($propertydata->update()){
				$data['status'] = 1;
				$data['msg'] = 'Property Data Saved';
			}
			else{
				$data['msg'] = 'Error in save property details';		
			}
		}
		return response()->json($data); 
		exit();
    }
	
	/**
     * Update Property SEO Info.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveseoinfo(Request $request){
		$data = array();
		$data['status'] = 0;
		$data['msg'] = 'Error';
		
		$input = $request->all();
		$propertyid = $input['propertyid'];
		
		$propertydata = Property::find($propertyid);
		
		if(empty($propertydata)){
			$data['msg'] = 'Invalid Property';
		}
		else{
			$propertydata->property_seourl = $input['seoinfo']['property_seourl'];
			$propertydata->property_metatitle = $request['seoinfo']['property_metatitle'];
			$propertydata->property_metakeywords = $request['seoinfo']['property_metakeywords'];
			$propertydata->property_metadesc = $request['seoinfo']['property_metadesc'];
			if($propertydata->update()){
				$data['status'] = 1;
				$data['msg'] = 'Property Saved';
			}
			else{
				$data['msg'] = 'Error in save property details';		
			}
		}
		
		return response()->json($data); 
		exit();
    }
	
	/**
     * Update Property Images Info.
     *
     * @return \Illuminate\Http\Response
     */
    public function savepropertyimages(Request $request){
		$data = array();
		$data['status'] = 0;
		$data['msg'] = 'Error';
		$data['imagesdata'] = '';
		
		$input = $request->all();
		$propertyid = $input['propertyid'];
		$finalfiles = (!empty($request->file('multipleimages')) && $request->file('multipleimages') != NULL) ? $request->file('multipleimages') : '';
		//$propertyimage = (empty($_FILES['mainimage']) && $_FILES['mainimage'] != NULL) ? $_FILES['mainimage'] : '';
		$propertymainimage = (!empty($request->file('mainimage')) && $request->file('mainimage') != NULL) ? $request->file('mainimage') : '';
		$propertylogoimage = (!empty($request->file('logoimage')) && $request->file('logoimage') != NULL) ? $request->file('logoimage') : '';
		$propertydocument = (!empty($request->file('propertydocument')) && $request->file('propertydocument') != NULL) ? $request->file('propertydocument') : '';
		$propertydata = Property::find($propertyid);
		
		
		if(empty($propertydata)){
			$data['msg'] = 'Invalid Property';
		}
		else{
			
			if($propertymainimage != ''){
				$imageName = 'mainimage.'.$propertymainimage->getClientOriginalExtension();
				$oldimage = $propertydata->property_mainimage;
				$path = public_path().'/images/property/'.$propertyid;
				$propertydata->property_mainimage = $imageName;
				if($propertydata->update()){
					File::makeDirectory($path, $mode = 0777, true, true);
					File::delete($path.'/'.$oldimage);
					$propertymainimage->move($path, $imageName);
				}
			}
			
			if($propertylogoimage != ''){
				$logoimageName = 'logoimage.'.$propertylogoimage->getClientOriginalExtension();
				$logooldimage = $propertydata->property_logoimage;
				$path = public_path().'/images/property/'.$propertyid;
				$propertydata->property_logoimage = $logoimageName;
				if($propertydata->update()){
					File::makeDirectory($path, $mode = 0777, true, true);
					File::delete($path.'/'.$logooldimage);
					$propertylogoimage->move($path, $logoimageName);
				}
			}
			
			if($propertydocument != ''){
				$docName = 'maindocument.'.$propertydocument->getClientOriginalExtension();
				$olddoc = $propertydata->property_document;
				$docpath = public_path().'/images/property/'.$propertyid;
				$propertydata->property_document = $docName;
				if($propertydata->update()){
					File::makeDirectory($docpath, $mode = 0777, true, true);
					File::delete($docpath.'/'.$olddoc);
					$propertydocument->move($docpath, $docName);
				}
				$data['newdocpath'] = URL::to('/').'/images/property/'.$propertyid.'/'.$docName;
			}
			
			//print_r($propertymainimage); die();
			//print_r($finalfiles); die();
			if($finalfiles != ''){
				foreach($finalfiles as $k=>$image){
					$propertyimagearray = array();
					$propertyimagearray['property_id'] = $propertyid;	
					$imageName = date('YmdHis').$propertyid.rand(0,9999).'.'.$image->getClientOriginalExtension();
					$propertyimagearray['image_name'] = $imageName;
					$uploadpath = public_path().'/images/property/'.$propertyid;
					if(PropertyImages::create($propertyimagearray)){
						$image->move($uploadpath, $imageName);
					}
				}
				$data['imagesdata'] = PropertyImages::where('property_id','=',$propertyid)->get();
			}
			$data['status'] = 1;
			$data['msg'] = 'Property Saved';
		}
		
		return response()->json($data); 
		exit();
    }
	
	/**
     * Delete Property Image Info.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletepropertyimage(Request $request){
		$data = array();
		$data['status'] = 0;
		$data['msg'] = 'Error';
		
		$input = $request->all();
		$propertyid = $input['propertyid'];
		$propertyimageid = $input['propertyimageid'];
		
		$propertydata = PropertyImages::find($propertyimageid);
		
		if(empty($propertydata)){
			$data['msg'] = 'Invalid Property Image';
		}
		else{
			if(PropertyImages::destroy($propertyimageid)){
				$oldimage = trim($propertydata->image_name);
				$imagepath = public_path().'/images/property/'.$propertyid;
				File::delete($imagepath.'/'.$oldimage);
				$data['status'] = 1;
				$data['msg'] = 'Property Saved';
			}
			else{
				$data['msg'] = 'Error';		
			}
		}
		
		return response()->json($data); 
		exit();
    }
	
	/**
     * Delete Whole Property.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($table,$field,$id){
		$propertyimagedata = PropertyImages::where('property_id','=',$id)->get();
		$propetydata = Property::where('property_id','=',$id)->first();
		$imagepath = public_path().'/images/property/'.$id;
		
		//dd($sliderimagedata);
		if(Property::destroy($id)){
			PropertyRooms::where('property_id','=',$id)->delete();
			PropertyImages::where('property_id','=',$id)->delete();
			$success = File::deleteDirectory($imagepath);
			Session::flash('alert-success', 'Property deleted successfully.');
		}
		else{
			Session::flash('alert-danger', 'There are some problem occured in delete property');
		}
		return redirect('admin/property');
    }
	
}
















