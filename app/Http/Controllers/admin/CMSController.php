<?php
// Added Amit on 07-03-2017
// New controller for community page of admin

namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\CMS;
use Validator;
use Session;
use DB;
use View;
use File;

class CMSController extends Controller {
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, CMS $cms) {
        $this->middleware('admin');
		$this->model = $cms;
		$this->currentcontroller = Route::currentRouteName();
		//dd($this->currentcontroller);
		View::share('title',ucfirst($this->currentcontroller));
		$this->messages = [
			'required' => 'The :attribute is required.',
			'unique' => 'The :attribute has already been assign to other CMS page.',
			'state_id.required' => 'Please select state.',
			//'employee_email.unique' => 'The :attribute has already been assign to other employee.',
		];
		$this->generaltitle = "CMS Management";
    }

    /**
     * Show the CMS Listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$cmsdata = CMS::with('Parentpagedata')->get();
		$title = $this->generaltitle;
		//dd($cmsdata);
		return view('admin.cms.cmslisting')->with(compact('cmsdata','title',''));
    }
	
	/**
     * Show the add CMS page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		$title = $this->generaltitle;
		$arrParentPageData = CMS::where('cms_parent_page','=','0')->orderBy('cms_page_title', 'asc')->get();
		$parentcmsdata = array();
		foreach($arrParentPageData as $parentpage)
		{
			$parentcmsdata[$parentpage->cms_page_id] = $parentpage->cms_page_title;
		}
		return view('admin.cms.addcms')->with(compact('title','parentcmsdata'));
    }
	
	/**
     * Add CMS Page Action.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		//dd($request->all());
		$validator = Validator::make($request->all(), [           
			'cms_page_title' => 'required|unique:cms_pages',
			'cms_content_title' => 'required',
			'cms_page_content' => 'required',
			'cms_content_image' => 'image',
			'cms_page_url' => 'required|unique:cms_pages',
			'cms_page_metatitle' => 'required',
			'cms_page_metadesc' => 'required',
			'cms_page_metakeywords' => 'required',
        ],$this->messages);
		
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
		}
			
		$input = $request->all();
		$input['hideon_site'] = (isset($input['hideon_site'])) ? 'YES' : 'NO';
		if(isset($request->cms_content_image) && !empty($request->cms_content_image) && $request->cms_content_image != NULL){
			$imageName = 'contentimage.'.$request->cms_content_image->getClientOriginalExtension();
			$input['cms_content_image'] = trim($imageName);
		}
		//dd($input);
		
		if($cms = CMS::create($input))
		{
			if(isset($request->cms_content_image) && !empty($request->cms_content_image) && $request->cms_content_image != NULL){
				$path = public_path().'/images/cmspages/'.$cms->cms_page_id;
				File::makeDirectory($path, $mode = 0777, true, true);
				$request->cms_content_image->move($path, $imageName);
			}
			$request->session()->flash('alert-success', 'CMS page created successfully.');
		}
		
		return redirect('admin/cms');
    }
	
	/**
     * Show the edit city page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($cmsid){
		//dd($cmsid);
		$title = $this->generaltitle;
		$cmsdata = CMS::find($cmsid);
		$arrParentPageData = CMS::where('cms_parent_page','=','0')->where('cms_page_id','!=',$cmsid)->orderBy('cms_page_title', 'asc')->get();
		$parentcmsdata = array();
		foreach($arrParentPageData as $parentpage)
		{
			$parentcmsdata[$parentpage->cms_page_id] = ucfirst($parentpage->cms_page_title);
		}
		return view('admin.cms.editcms')->with(compact('cmsid','title','cmsdata','parentcmsdata'));
    }
	
	/**
     * Update city info.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
		
		$validator = Validator::make($request->all(), [           
			'cms_page_title' => 'required|unique:cms_pages,cms_page_title,'.$request['cms_page_id'].',cms_page_id',
			'cms_content_title' => 'required',
			'cms_page_content' => 'required',
			'cms_content_image' => 'image',
			'cms_page_url' => 'required|unique:cms_pages,cms_page_url,'.$request['cms_page_id'].',cms_page_id',
			'cms_page_metatitle' => 'required',
			'cms_page_metakeywords' => 'required',
			'cms_page_metadesc' => 'required',
        ],$this->messages);
		
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
		}
		
		$cmsdata = CMS::find($request['cms_page_id']);
		
		if(empty($cmsdata))
		{
			$request->session()->flash('alert-danger', trans('Some problem occured in update CMS page details.'));
			return redirect('admin/cms');
		}
		
		$cmsdata->cms_page_title = $request['cms_page_title'];
		$cmsdata->cms_content_title = $request['cms_content_title'];
        $cmsdata->cms_page_content = $request['cms_page_content'];
		$cmsdata->cms_page_url = $request['cms_page_url'];
		$cmsdata->cms_page_metatitle = $request['cms_page_metatitle'];
		$cmsdata->cms_page_metadesc = $request['cms_page_metadesc'];
		$cmsdata->cms_page_metakeywords = $request['cms_page_metakeywords'];
		$cmsdata->cms_page_status = $request['cms_page_status'];
		$cmsdata->page_displayed_at = $request['page_displayed_at'];
		$cmsdata->hideon_site = (isset($request['hideon_site'])) ? 'YES' : 'NO';
		$cmsdata->cms_parent_page = $request['cms_parent_page'];
		
		if(isset($request->cms_content_image) && !empty($request->cms_content_image) && $request->cms_content_image != NULL){
			$imageName = 'contentimage.'.$request->cms_content_image->getClientOriginalExtension();
			$cmsdata->cms_content_image = trim($imageName);
		}
		
		if($cmsdata->update()){
			if(isset($request->cms_content_image) && !empty($request->cms_content_image) && $request->cms_content_image != NULL){
				$path = public_path().'/images/cmspages/'.$cmsdata->cms_page_id;
				File::makeDirectory($path, $mode = 0777, true, true);
				$request->cms_content_image->move($path, $imageName);
			}
			$request->session()->flash('alert-success', trans('CMS details updated successfully.'));
		}
		else{
			$request->session()->flash('alert-danger', trans('Some problem occured in update CMS details.'));			
		}
		
		return redirect('admin/cms');
    }
}
















