<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
	use HasFactory;

    protected $table = 'property';

    protected $fillable = ['type_id','title','image']; 
	
    public $timestamps = false;

	public function types()
	{
		return $this->belongsTo(Type::class, 'type_id', 'id');
	}

	public function locations()
	{
		return $this->belongsTo(Location::class, 'location_id', 'id');
	}

	public function users()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
	

	public static function getPropertyInfo($id,$field_name) 
    { 
		$info = Property::where('id',$id)->first();
		
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
