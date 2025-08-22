<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $fillable = ['name']; 
	
    public $timestamps = false;

	public function locationproperty()
	{
		return $this->hasMany(Property::class,'location_id','id');
	}

	public static function getLocationInfo($id,$field_name) 
    { 
		$info = Location::where('id',$id)->first();
		
		if($info)
		{
			return  $info->$field_name;
		}
		else
		{
			return  '';
		}
	}
	
	public static function getPropertyDetails($id) 
    { 
		$info = Property::where('id',$id)->first();
		
		return  $info;
	}
 
}
