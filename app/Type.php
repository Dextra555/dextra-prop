<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';

    protected $fillable = ['type_name','type_image'];
 
	
    public $timestamps = false;

	public function property()
	{
		return $this->hasMany(Property::class,'type_id','id');
	}

	public static function getTypeInfo($id,$field_name) 
    { 
		$info = Type::where('status','1')->where('id',$id)->first();
		
		if($info)
		{
			return  $info->$field_name;
		}
		else
		{
			return  '';
		}
	}
    
}
