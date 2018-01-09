<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class HomepageDetails extends Authenticatable
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
		protected $table = 'homepage_details';
	
	/**
     * The primary key defines in table.
     *
     * @var string
     */
		protected $primaryKey = 'id';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
		protected $fillable = [
			'banner_title', 'main_title', 'main_content', 'sidebar_image', 'meta_title', 'meta_keywords', 'meta_desc'
		];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
		protected $hidden = [

		];
}
