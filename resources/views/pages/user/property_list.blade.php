@extends('site_app')

@section('head_title', trans('words.my_properties').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
 

  <!--Breadcrumb section starts-->
  <div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.my_properties')}}</h2>
            <span><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></span> <span>{{trans('words.my_properties')}}</span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

  <!--My Properties section starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
			<div class="vfx-recent-activity my-listing">
				<div class="vfx-viewd-item-wrap">
					<div class="row">
						@foreach($property_list as $property_data)
						<div class="col-md-6" id="property_id_{{$property_data->id}}">
							<div class="vfx-most-viewed-item">
								<div class="vfx-most-viewed-img">
									<a href="{{ URL::to('properties/'.$property_data->slug.'/'.$property_data->id) }}"><img src="{{URL::to('/'.$property_data->image)}}" alt="..."></a>
									<ul class="vfx-feature-text">
										@if($property_data->purpose=='Rent')
										<li class="feature_cb"><span>{{trans('words.rent')}}</span></li>
										@else
										<li class="feature_or"><span>{{trans('words.sale')}}</span></li>
										@endif	
									</ul>
								</div>
								<div class="vfx-most-view-detail">
									<div class="d-flex">
										<p class="text-tlt mr-2">{{ $property_data->types->type_name }}</p>
										@if($property_data->status==1)
										<p class="lt_active" id="post_status{{$property_data->id}}">{{trans('words.active')}}</p>
										@else
										<p class="lt_pending" id="post_status{{$property_data->id}}">{{trans('words.pending')}}</p>		
										@endif
									</div>
									<h3><a href="{{ URL::to('properties/'.$property_data->slug.'/'.$property_data->id) }}">{{ Str::limit(stripslashes($property_data->title),25) }}</a></h3>
									<p class="vfx-list-address">
                    <i class="fa fa-map-marker"></i> 
                    @if(isset($property_data->locations->name) AND $property_data->locations->name!="")
                      {{$property_data->locations->name}}
                    @else
                      {{Str::limit(stripslashes($property_data->address),40)}}
                    @endif  
                </p>
									<div class="vfx-trend-open-price">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($property_data->price)}}</div>                                            
								</div>
								<div class="vfx-listing-button">
               
               @if(strtotime(date('m/d/Y')) < Auth::User()->exp_date)
                @if($property_data->status==1)
                    <a href="#" class="btn vfx4 enable_disable" data-toggle="tooltip" title="{{trans('words.active')}}" data-id="{{$property_data->id}}" data-value="{{$property_data->status}}" id="title_post_id{{$property_data->id}}"><i class="ion-flash" id="post_id{{$property_data->id}}"></i></a>

                @else
                   <a href="#" class="btn vfx4 enable_disable" data-toggle="tooltip" title="{{trans('words.pending')}}" data-id="{{$property_data->id}}" data-value="{{$property_data->status}}" id="title_post_id{{$property_data->id}}"><i class="ion-flash-off" id="post_id{{$property_data->id}}"></i></a>
                @endif
              @endif 

                  <a href="{{ url('user/property/edit/'.$property_data->id) }}" class="btn vfx4" data-toggle="tooltip" title="Edit"><i class="ion-edit"></i></a>
									<a href="#" class="btn vfx4 data_remove" data-toggle="tooltip" title="Delete"  data-id="{{$property_data->id}}"><i class="ion-android-delete"></i></a>
								</div>
							</div>
						</div>
						@endforeach
 
						 
					</div>

					<!--pagination starts-->
					<div class="post-nav nav-res pt-20">
							<div class="row">
							
								@include('_particles.pagination', ['paginator' => $property_list]) 

							</div>
						</div>
            <!--pagination ends-->

				</div>
			</div>	
         </div>
      </div>
    </div>
  </div>
  <!--My Properties section ends--> 
  
  <!-- Scroll to top starts--> 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 
  <!-- Scroll to top ends--> 

  <script src="{{ URL::asset('site_assets/js/jquery.min.js') }}"></script>


  <script type="text/javascript">
 
  $(".enable_disable").on('click', function () {      
    
      'use strict';
        
       var post_id = $(this).data("id");
       
       var status_value = $(this).data("value"); 
 
       var action_name='property_status';
       
 
       $.ajax({
         type: 'post',
         url: "{{ URL::to('ajax_actions') }}",
         dataType: 'json',
         data: {"_token": "{{ csrf_token() }}",id: post_id, value: status_value, action_for: action_name},
         success: function(res) {
 
           if(res.status=='1')
           {

            //slider_id
            var title_post_id= '#title_post_id'+post_id;
            
            var p_post_id= '#post_id'+post_id;
            var p_post_status= '#post_status'+post_id;            
            
            $(p_post_id).attr('class', res.status_set_icon); 
            $(title_post_id).attr('data-original-title', res.set_title);
            $(title_post_id).data('value', res.new_status_value); 

            $(p_post_status).attr('class', res.set_class); 
            $(p_post_status).html(res.set_title);
             

             Swal.fire({
                     position: 'center',
                     icon: 'success',
                     title: '{{trans('words.status_changed')}}',
                     showConfirmButton: true,
                     confirmButtonColor: '#10c469',
                     background:"#1a2234",
                     color:"#fff"
                   })
              
           } 
           else
           { 
             Swal.fire({
                     position: 'center',
                     icon: 'error',
                     title: 'Something went wrong!',
                     showConfirmButton: true,
                     confirmButtonColor: '#10c469',
                     background:"#1a2234",
                     color:"#fff"
                   })
           }
           
         }
       });
 }); 
 
 </script>


<script type="text/javascript">
//Single
$(".data_remove").on('click', function () {      

  'use strict';
  
  var post_id = $(this).data("id");
  var action_name='property_delete';

  Swal.fire({
  title: '{{trans('words.dlt_warning')}}',
  text: "{{trans('words.dlt_warning_text')}}",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: '{{trans('words.dlt_confirm')}}',
  cancelButtonText: "{{trans('words.btn_cancel')}}",
  background:"#1a2234",
  color:"#fff"

}).then((result) => {
  

    if(result.isConfirmed) { 

        $.ajax({
            type: 'post',
            url: "{{ URL::to('ajax_actions') }}",
            dataType: 'json',
            data: {"_token": "{{ csrf_token() }}",id: post_id, action_for: action_name},
            success: function(res) {

              if(res.status=='1')
              {  

                  var selector = "#property_id_"+post_id;
                    $(selector ).fadeOut(1000);
                    setTimeout(function(){
                            $(selector ).remove()
                        }, 1000);

                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '{{trans('words.deleted')}}!',
                    showConfirmButton: true,
                    confirmButtonColor: '#10c469',
                    background:"#1a2234",
                    color:"#fff"
                  })
                
              } 
              else
              { 
                Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Something went wrong!',
                        showConfirmButton: true,
                        confirmButtonColor: '#10c469',
                        background:"#1a2234",
                        color:"#fff"
                       })
              }
              
            }
        });
    }
 
})

});
</script>

@endsection