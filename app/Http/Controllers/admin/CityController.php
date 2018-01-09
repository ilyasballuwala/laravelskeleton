<?php
// Added Amit on 07-03-2017
// New controller for community page of admin

namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\City;
use App\State;
use Validator;
use Session;
use DB;
use View;

class CityController extends Controller {
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, City $city) {
        $this->middleware('admin');
		$this->model = $city;
		$this->currentcontroller = Route::currentRouteName();
		//dd($this->currentcontroller);
		View::share('title',ucfirst($this->currentcontroller));
		$this->messages = [
			'required' => 'The :attribute field is required.',
			//'unique' => 'The :attribute has already been assign to other city.',
			'state_id.required' => 'Please select state.',
			'city_name.unique' => 'City name is already registered for this state.',
			'city_abbr.unique' => 'City Abbrevation is already registered for this state.',
		];
    }

    /**
     * Show the City Listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$citydata = City::with('StateData')->get();
		$title = 'City Management';
		//dd($statedata);
		return view('admin.city.citylisting')->with(compact('citydata','title'));
    }
	
	/**
     * Show the add city page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		$title = 'City Management';
		$tempstatedata = State::where('state_status','=','1')->orderBy('state_name', 'asc')->get();
		foreach($tempstatedata as $state)
		{
			$statedata[$state->state_id] = $state->state_name;
		}
		return view('admin.city.addcity')->with(compact('title','statedata'));
    }
	
	/**
     * Add City Action.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		//dd($request->all());
		$input = $request->all();
		
		$validator = Validator::make($request->all(), [           
			'city_name' => 'required|unique:city,city_name,NULL,city_id,state_id,'.$input['state_id'],
			'city_abbr' => 'required|unique:city,city_abbr,NULL,city_id,state_id,'.$input['state_id'],
			'state_id' => 'required',
        ],$this->messages);
		
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
		}
		
		$input['city_name'] = ucfirst($input['city_name']);
		$input['city_abbr'] = strtoupper($input['city_abbr']);
		//dd($input);
		
		if(City::create($input))
		{
			$request->session()->flash('alert-success', 'City created successfully.');
		}
		
		return redirect('admin/city');
    }
	
	/**
     * Show the edit city page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($cityid){
		//dd($cityid);
		$title = 'City Management';
		$citydata = City::find($cityid);
		$tempstatedata = State::where('state_status','=','1')->orderBy('state_name', 'asc')->get();
		foreach($tempstatedata as $state)
		{
			$statedata[$state->state_id] = $state->state_name;
		}
		return view('admin.city.editcity')->with(compact('cityid','title','citydata','statedata'));
    }
	
	/**
     * Update city info.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
		
		$validator = Validator::make($request->all(), [           
			'city_name' => 'required|unique:city,city_name,'.$request['city_id'].',city_id,state_id,'.$request['state_id'],
			'city_abbr' => 'required|unique:city,city_abbr,'.$request['city_id'].',city_id,state_id,'.$request['state_id'],
			'state_id' => 'required',
        ],$this->messages);
		
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
		}
		
		$citydata = City::find($request['city_id']);
		
		if(empty($citydata))
		{
			$request->session()->flash('alert-danger', trans('Some problem occured in update city details.'));
			return redirect('admin/city');
		}
		
		$citydata->city_name = ucfirst($request['city_name']);
        $citydata->city_abbr = strtoupper($request['city_abbr']);
		$citydata->state_id = $request['state_id'];
		$citydata->city_status = $request['city_status'];
			
		if($citydata->update()){
			$request->session()->flash('alert-success', trans('City details updated successfully.'));
		}
		else{
			$request->session()->flash('alert-danger', trans('Some problem occured in update city details.'));			
		}
		
		return redirect('admin/city');
    }
	
	/**
     * Delete city page.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($table,$field,$id){
		$propertycount = DB::table('property')->where('property_city','=',$id)->count();
		//dd($propertycount);
		if($propertycount > 0){
			Session::flash('alert-danger', 'There are '.$propertycount.' properties(s) are dependent on this city. So please remove that propertie(s) and then you will delete this city.');
		}
		else{
			if(City::destroy($id)){
				Session::flash('alert-success', 'City deleted successfully.');
			}
			else{
				Session::flash('alert-danger', 'There are some problem occured in delete '.ucfirst(str_replace('_',' ',$table)));
			}
		}
		return redirect('admin/city');
    }
}
















