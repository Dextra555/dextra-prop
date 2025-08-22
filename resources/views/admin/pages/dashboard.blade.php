@extends("admin.admin_app")

@section("content")

  

<div class="content-page">
      <div class="content">
        <div class="container-fluid">

         
          @if(Auth::User()->usertype=="Admin")  
                <div class="row">
                     
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/type')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup">{{$type}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.type_text')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/property')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-success" data-plugin="counterup">{{$property}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.property_text')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
  

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/users')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-info" data-plugin="counterup">{{$users}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.users')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                     

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/reports')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-dark" data-plugin="counterup">{{$reports}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.reports')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                     
                </div> 

                <div class="row">    

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup">{{number_format($daily_amount,2)}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.daily_revenue')}}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-pink" data-plugin="counterup">{{number_format($weekly_amount,2)}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.weekly_revenue')}}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-warning" data-plugin="counterup">{{number_format($monthly_amount,2)}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.monthly_revenue')}}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-success" data-plugin="counterup">{{number_format($yearly_amount,2)}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.yearly_revenue')}}</h5>
                            </div>
                        </div>
                    </div>


                    </div>

                  
                <div class="row">
                <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            

                            <h4 class="header-title mt-0 m-b-5">{{trans('words.latest_property')}}</h4>
                            <p class="text-muted m-b-20">{{trans('words.latest_10_property')}}</p>

                            <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">
                                
                            @foreach($latest_property as $latest_data)
                                 
                                <a href="Javascript::void(0);" class="text-inverse">
                                
                                <p class="font-600 m-b-5">  
                                    {{Str::limit(stripslashes($latest_data->title), 25)}} 
                                     
                                    <span class="badge badge-danger pull-right">{{number_format_short(post_views_count($latest_data->id,"Property"))}} {{trans('words.views')}}  </span>
                                </p>

                                </a>

                                @endforeach
                                 
                            </div>
                        </div>
                </div>

                <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            

                            <h4 class="header-title mt-0 m-b-5">{{trans('words.trending_now')}}</h4>
                            <p class="text-muted m-b-20">{{trans('words.based_on_30_days')}}</p>

                            <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">
                                
                            @foreach($trending_now as $trending_data)
                                 
                                <a href="Javascript::void(0);" class="text-inverse">
                                
                                <p class="font-600 m-b-5">  
                                    {{Str::limit(stripslashes(\App\Property::getPropertyInfo($trending_data->post_id,'title')), 25)}} 
                                     
                                    <span class="badge badge-danger pull-right">{{number_format_short($trending_data->total_views)}} {{trans('words.views')}}  </span>
                                </p>

                                </a>

                                @endforeach
                                 
                            </div>
                        </div>
                </div>
                 

                <div class="col-xl-4 col-md-6">
                    <div class="card-box">
                        

                        <h4 class="header-title mt-0 m-b-5">{{trans('words.latest_transactions')}}</h4>
                        <p class="text-muted m-b-20">{{trans('words.latest_5_transactions')}}</p>

                        
                      
                        <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">

                            @foreach($latest_transactions as $transaction_data)

                                 <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="{{ URL::asset('admin_assets/images/user-default.png') }}" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author text-white">{{ \App\User::getUserFullname($transaction_data->user_id) }}</p>
                                    <p class="inbox-item-text">
                                    {{ $transaction_data->gateway }} -      
                                    {{ $transaction_data->payment_id }}</p>
                                    <p class="inbox-item-date">
                                    <b class="text-success">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}} {{ $transaction_data->payment_amount }}</b> - {{ date('M d Y',$transaction_data->date) }}</p>
                                </div>

                            @endforeach
       
                             
                        </div>
                    </div>
                </div>

                  

                <div class="col-xl-8 col-md-6">
                <div class="card-box">
                         
                         <h4 class="header-title mt-0 m-b-30">{{trans('words.latest_reports')}}</h4>

                         <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width: 15%;">&nbsp;</th>
                                                <th style="width: 15%;">{{trans('words.name')}}</th>
                                                <th style="width: 40%;">{{trans('words.message')}}</th>
                                                <th style="text-align: center">Date</th>
                                                <th>&nbsp;</th> 
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reports_list as $reports_data)    
                                             
                                            <tr>
                                                    <td>
                                                    <div class="inbox-item-img">
                                                    @if(isset(\App\User::getUserInfo($reports_data->user_id)->user_image))
                                                    <img src="{{URL::to('upload/'.\App\User::getUserInfo($reports_data->user_id)->user_image)}}" class="rounded-circle" alt="" width="50">
                                                    @else
                                                    <img src="{{URL::to('admin_assets/images/user-default.png')}}" class="rounded-circle" alt="" width="50">
                                                    @endif                                         
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <p class="inbox-item-author" style="color:#fff;">{{\App\User::getUserFullname($reports_data->user_id)}}</p>
                                                    </td>
                                                    <td>
                                                        <p class="inbox-item-text">{{Str::limit($reports_data->message,70)}}</p>
                                                    </td>
                                                     <td style="text-align: center">
                                                        <span class="badge badge-success">{{ date('m-d-Y h:i a',$reports_data->date) }}</span>
                                                    </td>
                                                    <td>
                                                    <a href="{{URL::to('admin/reports')}}" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-info"></i> </a>
                                                    </td>
                                                 </tr>
                                                 
                                            @endforeach       
                                        

                                            </tbody>
                                        </table>
                                    </div>
 
                          
                     </div>
                </div><!-- end col-->
 
                       
          </div>
          
          @else

                <div class="row">
                     
                <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/type')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup">{{$type}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.type_text')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/property')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-success" data-plugin="counterup">{{$property}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.property_text')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
  

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/users')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-info" data-plugin="counterup">{{$users}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.users')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                     

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/reports')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-dark" data-plugin="counterup">{{$reports}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.reports')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    
                </div> 


          @endif 
        
        </div>

        
      </div>
      @include("admin.copyright") 
    </div>

    <script type="text/javascript">
    'use strict';    
     
    @if(Session::has('flash_message'))     
 
 
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,         
      })

      Toast.fire({
        icon: 'success',
        title: '{{ Session::get('flash_message') }}'
      })     
     
  @endif
 
  </script>
  
 
@endsection