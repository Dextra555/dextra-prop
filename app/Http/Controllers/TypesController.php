<?php

namespace App\Http\Controllers;

use App\Type;
use App\Property;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

 
class TypesController extends Controller
{   
 	  
    public function types()
    {    
        $type_list= Type::where('status',1)->orderby('type_name')->paginate(12);

        return view('pages.types.list',compact('type_list'));              
         
    }

    public function types_property($type_slug,$type_id)
    {   

        $type_info = Type::where('id',$type_id)->first();
 

        $sort_by = $_GET['sort_by'] ?? 'New';
         
        $property_list = Property::with(['types', 'locations', 'users'])
            ->where('status', 1)
            ->where('approval_status','approved')
            ->where('type_id',$type_id);

        switch ($sort_by) {
            case 'Old':
                $property_list = $property_list->orderBy('id', 'ASC');
                break;

            case 'High':
                $property_list = $property_list->orderBy('price', 'DESC');
                break;

            case 'Low':
                $property_list = $property_list->orderBy('price', 'ASC');
                break;

            case 'New':
            default:
                $property_list = $property_list->orderBy('id', 'DESC');
                break;
        }

         $property_list = $property_list->paginate(10)->appends(Request::only('sort_by'));
        

        return view('pages.types.property_list',compact('property_list','type_info'));              
         
    }

}
