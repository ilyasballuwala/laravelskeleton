<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class PropertyImages extends Authenticatable
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
		protected $table = 'property_image';
	
	/**
     * The primary key defines in table.
     *
     * @var string
     */
		protected $primaryKey = 'image_id';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
		protected $fillable = [
			'image_name', 'property_id',
		];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
		protected $hidden = [

		];
		
		/**
		 * This function get the Property data 
		 *
		 * @return Property
		 */
		public function Propertydata(){
			return $this->belongsTo('App\Property','property_id','property_id');	
		}
}
