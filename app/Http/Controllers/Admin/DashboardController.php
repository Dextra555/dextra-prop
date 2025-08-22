<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Type;
use App\Property;
use App\Reports;
use App\Transactions;
 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan; 
 
class DashboardController extends MainAdminController 
{
	public function __construct()
    {    
         parent::__construct();
          
    }
 

    public function index()
    { 
            if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin" AND Auth::User()->usertype!="Company")
            {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('dashboard');                
            }
              
            $type = Type::count();               
            $property = Property::count();
            $users = User::where('usertype','User')->count(); 
            $reports = Reports::count();

            //Revenue
            $start_day = date('Y-m-d 00:00:00');
            $finish_day = date('Y-m-d 23:59:59');
            $daily_amount= Transactions::whereBetween('date', array(strtotime($start_day), strtotime($finish_day)))->sum('payment_amount');

            $start_week = (date('D') != 'Mon') ? date('Y-m-d', strtotime('last Monday')) : date('Y-m-d');
            $finish_week = (date('D') != 'Sat') ? date('Y-m-d', strtotime('next Saturday')) : date('Y-m-d');
            $weekly_amount= Transactions::whereBetween('date', array(strtotime($start_week), strtotime($finish_week)))->sum('payment_amount');

            $start_month = date('Y-m-d', strtotime('first day of this month'));
            $finish_month = date('Y-m-d', strtotime('last day of this month'));             
            $monthly_amount = Transactions::whereBetween('date', array(strtotime($start_month), strtotime($finish_month)))->sum('payment_amount');

            $current_year = date('Y'); 
            $start_day_year = "January 1st, {$current_year}";
            $end_day_year = "December 31st, {$current_year}";
            $yearly_amount = Transactions::whereBetween('date', array(strtotime($start_day_year), strtotime($end_day_year)))->sum('payment_amount');

            //Latest
            $latest_property = Property::where('status',1)->orderBy('id','DESC')->take(10)->get();
            
            //Trending
            $trending_start_date = date('Y-m-d', strtotime('today - 30 days'));
            $trending_end_date = date('Y-m-d'); 
            
            $trending_now = DB::table('post_views')
            ->select('post_views.post_id','post_views.post_type','property.id')
            ->join('property','property.id','=','post_views.post_id')
            ->where('property.status',1)->whereBetween('post_views.date', array(strtotime($trending_start_date), strtotime($trending_end_date)))->selectRaw('SUM(post_views) as total_views')->groupBy('property.id','post_views.post_id','post_views.post_type')->orderby('total_views','DESC')->limit(10)->get();                

                //Latest Transactions
                $latest_transactions = Transactions::orderBy('id','DESC')->take(10)->get();

            //Latest Reports
            $reports_list = Reports::orderby('id','DESC')->take(10)->get();
            
            $page_title = trans('words.dashboard_text')?trans('words.dashboard_text'):'Dashboard';
                
            return view('admin.pages.dashboard',compact('page_title','type','property','users','reports','latest_property','trending_now','reports_list','daily_amount','weekly_amount','monthly_amount','yearly_amount','latest_transactions'));                  
           
    }
		
    public function cache()
    {
        Artisan::call('optimize:clear');
        removeFile(storage_path('logs/laravel.log'));

        \Session::flash('flash_message', trans('words.cache_cleared'));
        return \Redirect::back();
    }
    	
}
