<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CMS extends Authenticatable
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
		protected $table = 'cms_pages';
	
	/**
     * The primary key defines in table.
     *
     * @var string
     */
		protected $primaryKey = 'cms_page_id';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
		protected $fillable = [
			'cms_page_title', 'cms_content_title', 'cms_page_content', 'cms_content_image', 'cms_page_url', 'cms_page_metatitle', 'cms_page_metakeywords', 'cms_page_metadesc', 'cms_parent_page', 'page_displayed_at', 'hideon_site', 'cms_page_status',
		];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
		protected $hidden = [

		];
		
		/**
		 * This function get the parent page CMS data 
		 *
		 * @return State
		 */
		public function Parentpagedata(){
			return $this->belongsTo('App\CMS','cms_parent_page','cms_page_id');	
		}
		
		/**
		 * This function get the child CMS pages data 
		 *
		 * @return State
		 */
		public function Childpagedata(){
			return $this->hasMany('App\CMS','cms_parent_page','cms_page_id')->where('cms_page_status','=','1')->where('hideon_site','No');	
		}
}
