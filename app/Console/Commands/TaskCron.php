<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

use App\Property;

class TaskCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification Email sending';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info("Cron is working fine!");
        
       
        //$TomorrowDate = strtotime(date('Y-m-d', strtotime('+1 days', strtotime(date('Y-m-d')))));

        $TodayDate=strtotime(date('Y-m-d'));

         $users = DB::table('users')
                    ->where('status',1)
                    ->where('exp_date','=',$TodayDate)
                    ->get();

         if (count( $users)<=0)
         {
            echo "No Subscription renew data found";
            exit;
         }  

         foreach ($users as $user_data) {
            
            $user_id= $user_data->id;

            $pro_obj = Property::where('user_id',$user_id)->update(['status'=>0]);     

            Mail::to($user_data->email)->send(new SendEmail($user_data));     
         } 

        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
