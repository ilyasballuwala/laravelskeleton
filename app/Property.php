<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Property extends Authenticatable
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
		protected $table = 'property';
	
	/**
     * The primary key defines in table.
     *
     * @var string
     */
		protected $primaryKey = 'property_id';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
		protected $fillable = [
			'property_name', 'property_location', 'property_desc', 'property_state', 'property_city', 'property_seourl', 'property_email', 'property_status', 'property_mainimage', 'property_logoimage', 'property_address', 'property_postalcode', 'property_phoneno', 'property_officehours', 'property_document', 'property_amenities', 'property_features', 'property_metatitle', 'property_metakeywords', 'property_metadesc', 'property_uniquekey',
		];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
		protected $hidden = [

		];
		
		/**
		 * This function get the Property Images data 
		 *
		 * @return Property Images
		 */
		public function Propertyimagedata(){
			return $this->hasMany('App\PropertyImages','property_id','property_id');	
		}
	
		/**
		 * This function get the Property State data 
		 *
		 * @return Property State
		 */
		public function Propertystate(){
			return $this->belongsTo('App\State','property_state','state_id');	
		}
	
		/**
		 * This function get the Property City data 
		 *
		 * @return Property City
		 */
		public function Propertycity(){
			return $this->belongsTo('App\City','property_city','city_id');	
		}
	
		/**
		 * This function get the Property Rooms data 
		 *
		 * @return Property Rooms
		 */
		public function Propertyroomsdata(){
			return $this->hasMany('App\PropertyRooms','property_id','property_id');	
		}
}
