<?php

namespace App\Http\Controllers;


use App\Property;
use App\Pages;
use App\Http\Controllers\Controller; 
 
class SitemapController extends Controller
{   
 	  
    public function sitemap()
    {    
        return response()->view('pages.sitemap')->header('Content-Type', 'text/xml');
    }

    public function sitemap_misc()
    {   
        $pages_list = Pages::where('status',1)->orderBy('id')->get();

        return response()->view('pages.sitemap_misc',compact('pages_list'))->header('Content-Type', 'text/xml');
    }
 

    public function sitemap_property()
    {   
        $property_list = Property::where('status',1)->orderBy('id','DESC')->get();

        return response()->view('pages.sitemap_property',compact('property_list'))->header('Content-Type', 'text/xml');
    }


}
