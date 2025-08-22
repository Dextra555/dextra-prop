@extends('site_app')

@section('head_title', trans('words.favourite_properties').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
 

  <!--Breadcrumb section starts-->
  <div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.favourite_properties')}}</h2>
            <span><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></span> <span>{{trans('words.favourite_properties')}}</span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

  <!--Favourite Property section starts-->
  <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
			<div class="vfx-recent-activity my-listing">                                
				<div class="vfx-viewd-item-wrap">
					<div class="row">
            @foreach($favourites_list as $favourites)

            @php 
                $post_id=$favourites->post_id;

                $property_info= \App\Property::find($post_id);
            @endphp
						<div class="col-lg-6 col-md-12" id="post_id_{{$post_id}}">
							<div class="vfx-most-viewed-item">
								<div class="vfx-most-viewed-img">
									<a href="{{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" title="{{stripslashes($property_info->title)}}"><img src="{{\URL::to('/'.$property_info->image)}}" alt="image" title="image"></a>
									<ul class="vfx-feature-text">
                          @if($property_info->purpose=='Rent')
                          <li class="feature_cb"><span>{{trans('words.rent')}}</span></li>
                          @else
                          <li class="feature_or"><span>{{trans('words.sale')}}</span></li>
                          @endif
									</ul>
								</div>
								<div class="vfx-most-view-detail">
									<p class="text-tlt">{{ $property_info->types->type_name }}</p>
									<h3><a href="{{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}">{{stripslashes($property_info->title)}}</a></h3>
									<p class="vfx-list-address"><i class="fa fa-map-marker"></i>
                      @if(isset($property_info->locations->name) AND $property_info->locations->name!="")
                        {{$property_info->locations->name}}
                      @else
                      {{Str::limit(stripslashes($property_info->address),40)}}
                      @endif  
                  </p>
									<div class="vfx-trend-open-price">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($property_info->price)}}</div>                                            
								</div>
								<div class="vfx-listing-button">
									<a href="#" data-id="{{$property_info->id}}" class="btn vfx4 fav_data_remove" data-toggle="tooltip" title="Delete"><i class="ion-android-delete"></i></a>
								</div>
							</div>
						</div>
            @endforeach					 
						 
					</div>
				</div>
			</div>	
         </div>
      </div>
    </div>
  </div>
  <!--Favourite Property section ends--> 
  
  <!-- Scroll to top starts--> 
  <span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 
  <!-- Scroll to top ends--> 

<script src="{{ URL::asset('site_assets/js/jquery.min.js') }}"></script>

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