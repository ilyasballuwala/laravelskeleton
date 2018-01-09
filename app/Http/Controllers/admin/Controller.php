<?php
// Added Amit on 01-03-2017
// New controller for 'Admin' section

namespace App\Http\Controllers\admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Session;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		/*$this->storeid = \Auth::guard('storeadmin')->user()->employee_store;
		$this->employee_role = \Auth::guard('storeadmin')->user()->employee_role;
		$this->state = Config::get("custom.allstate");
		$this->employeedata = Storeadmin::where('employee_store',$this->storeid)->get();
		foreach($this->employeedata as $k=>$employee)
		{
			$this->storeemployee[] = $employee['employee_id'];
		}
		$this->productrequestcount = Productorders::with('Requestfromstoredata','Requesttostoredata')->where('requestto_storeid',$this->storeid)->where('productorder_status',2)->count();

		View::share ( 'storeemployee', $this->storeemployee );
		View::share ( 'currentstore', $this->storedata );
		View::share ( 'statedata', $this->state );
		View::share ( 'employeerole', $this->employee_role );
		View::share ( 'productrequestcount', $this->productrequestcount );*/
    }
	
	public function generaldelete(Request $request, $controller, $table = NULL, $field, $id = NULL)
	{
		if(DB::table($table)->where($field, '=', $id)->delete()){
			$request->session()->flash('alert-success', ucfirst($table).' deleted successfully.');
		}
		else{
			$request->session()->flash('alert-danger', 'There are some problem occured in delete '.ucfirst(str_replace('_',' ',$table)));
		}
		return redirect('admin/'.$controller);
	}
	
}
