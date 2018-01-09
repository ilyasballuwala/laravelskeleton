<?php
// Added Amit on 07-03-2017
// New controller for community page of admin

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\State;
use Validator;
use Session;
use DB;
use View;

class StateController extends Controller {
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, State $state) {
        $this->middleware('admin');
		$this->model = $state;
		$this->currentcontroller = Route::currentRouteName();
		//dd($this->currentcontroller);
		View::share('title',ucfirst($this->currentcontroller));
    }

    /**
     * Show the State Listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$statedata = State::get();
		$title = 'State Management';
		//dd($statedata);
		return view('admin.state.statelisting')->with(compact('statedata','title'));
    }
	
	/**
     * Show the add state page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		$title = 'State Management';
		return view('admin.state.addstate')->with(compact('title'));
    }
	
	/**
     * Add State Action.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		//dd($request->all());
		$validator = Validator::make($request->all(), [           
			'state_name' => 'required|unique:state',
			'state_abbr' => 'required|unique:state',
        ]);
		
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
		}
			
		$input = $request->all();
		$input['state_name'] = ucfirst($input['state_name']);
		$input['state_abbr'] = strtoupper($input['state_abbr']);
		//dd($input);
		
		if(State::create($input))
		{
			$request->session()->flash('alert-success', 'State created successfully.');
		}
		
		return redirect('admin/state');
    }
	
	/**
     * Show the edit state page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($stateid){
		//dd($stateid);
		$title = 'State Management';
		$statedata = State::find($stateid);
		return view('admin.state.editstate')->with(compact('stateid','title','statedata'));
    }
	
	/**
     * Update state info.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
		
		$validator = Validator::make($request->all(), [           
			'state_name' => 'required|unique:state,state_name,'.$request['state_id'].',state_id',
			'state_abbr' => 'required|unique:state,state_abbr,'.$request['state_id'].',state_id',
        ]);
		
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
		}
		
		$statedata = State::find($request['state_id']);
		
		if(empty($statedata))
		{
			$request->session()->flash('alert-danger', trans('Some problem occured in update state details.'));
			return redirect('admin/state');
		}
		
		$statedata->state_name = ucfirst($request['state_name']);
        $statedata->state_abbr = strtoupper($request['state_abbr']);
		$statedata->state_status = $request['state_status'];
			
		if($statedata->update()){
			$request->session()->flash('alert-success', trans('State details updated successfully.'));
		}
		else{
			$request->session()->flash('alert-danger', trans('Some problem occured in update state details.'));			
		}
		
		return redirect('admin/state');
    }
	
	/**
     * Delete state page.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($table,$field,$id){
		$citycount = DB::table('city')->where('state_id','=',$id)->count();
		//dd($citycount);
		if($citycount > 0){
			Session::flash('alert-danger', 'There are '.$citycount.' citie(s) are dependent on this state. So please remove that city and then you will delete this state.');
		}
		else{
			if(State::destroy($id)){
				Session::flash('alert-success', 'State deleted successfully.');
			}
			else{
				Session::flash('alert-danger', 'There are some problem occured in delete '.ucfirst(str_replace('_',' ',$table)));
			}
		}
		return redirect('admin/state');
    }
	
}
















