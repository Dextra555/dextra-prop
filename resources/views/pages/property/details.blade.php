@extends('site_app')

@section('head_title', stripslashes($property_info->title).' - '.getcong('site_name') )

@section('head_description', Str::limit(stripslashes($property_info->description),160))

@section('head_image', URL::to('/'.$property_info->image))

@section('head_url', Request::url())

@section('content')

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "{{stripslashes($property_info->title)}}",
        "description": "{{Str::limit(stripslashes(strip_tags($property_info->description)),155)}}",
        "image":["{{\URL::to('/'.$property_info->image)}}"],        
        "offers": {
            "@type": "Offer",
            "priceCurrency": "{{getcong('currency_code')}}",
            "price": "{{$property_info->price}}",
            "availability": "https://schema.org/InStock",
            "url": "{{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}"
             
        },
        "additionalProperty": [
            {
                "@type": "PropertyValue",
                "name": "Number of Bedrooms",
                "value": "{{$property_info->bedrooms}}"
            },
            {
                "@type": "PropertyValue",
                "name": "Number of Bathrooms",
                "value": "{{$property_info->bathrooms}}"
            },
            {
                "@type": "PropertyValue",
                "name": "Total Area",
                "value": "{{$property_info->area}}"
            }
        ],
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{stripslashes($property_info->address)}}",
            "addressLocality": "{{get_location_info($property_info->location_id,'name')}}",
            "addressRegion": "",
            "postalCode": "",
            "addressCountry": ""
        }
    }
    </script>
 
   
<div class="property-details-wrap bg-cb mt-70"> 

@if(get_web_banner('details_top')!="")      
    <div class="add_banner_section pb-0">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
            {!!stripslashes(get_web_banner('details_top'))!!}
          </div>
        </div>  
      </div>
    </div>
@endif
 
	<!--Listing Details Info starts-->
    <div class="single-property-details vfx1"> 
      <div class="container">
        <div class="row">     
          <div class="col-xl-8 col-lg-12">
			<div class="single-property-header mt-30">
 
				<div class="row">
					<div class="col-md-12">
						<div class="property_poster_item">
							<img class="d-block" src="{{\URL::to('/'.$property_info->image)}}" alt="slide" title="property_header_1">
						</div>
					</div>
				</div>
			</div>
			
		    <div class="list-details-title vfx1">
 
			  <div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12">
				  <div class="single-listing-title float-left">
					<h2>{{stripslashes($property_info->title)}}

            @if($property_info->purpose=='Rent')
            <span class="btn vfx5">{{trans('words.rent')}}</span>
             @else
            <span class="btn vfx5">{{trans('words.sale')}}</span>
             @endif

            @if($property_info->verified=='YES')
            <i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{trans('words.verified')}}"></i><span></span>
            @endif 
          </h2>
					<p><i class="fa fa-map-marker"></i> 
              @if(get_location_info($property_info->location_id,'name')!="")
                {{get_location_info($property_info->location_id,'name')}}
              @else
              {{stripslashes($property_info->address)}}
              @endif
           </p>
					<div class="dtl_social mt-15">
						<ul>
							<li><a href="#" title="model" data-toggle="modal" data-target="#vfx-report-popup"><i class="fa fa-book mr-2"></i>Reports</a></li>
							<li><a href="#" title="model" data-toggle="modal" data-target="#vfx-social-media-popup"><i class="fa fa-share-alt mr-2"></i>Share</a></li>
						</ul>
 
					</div> 
				  </div>
				</div>
 
				<div class="col-lg-3 col-md-3 col-sm-12">
				  <div class="list-details-btn text-right sm-left">
					<div class="list-details-btn">
					  <div class="vfx-trend-open-price">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($property_info->price)}}</div>
					</div>
				  </div>
				</div> 
			  </div>
       
			</div>
            <div class="listing-desc-wrap">
              <div class="list-details-wrap">
                <div id="description" class="list-details-section">
                  <h4>{{trans('words.property_info')}}</h4>
                  <div class="overview-content">
                    <p class="mb-10">{!!stripslashes($property_info->description)!!}</p>
                    
                    <p class="mt-30"><b>{{trans('words.address')}}</b> : {{stripslashes($property_info->address)}}
                    </p>
                  </div>
                   
                  <div class="mt-40">
                    <h4 class="list-subtitle">{{trans('words.location')}}</h4>
                     
                    <ul class="listing-address">
                    <iframe 
                    width="750" 
                    height="350" 
                    frameborder="0" 
                    scrolling="no" 
                    marginheight="0" 
                    marginwidth="0" 
                    src="https://maps.google.com/maps?q={{$property_info->latitude}},{{$property_info->longitude}}&hl=es&z=14&amp;output=embed"
                  >
                  </iframe>
                    </ul>
                  </div>
                </div>
                <div id="gallery" class="list-details-section">
                  <h4>{{trans('words.property_gallery')}}</h4>
                  <!--Carousel Wrapper-->
                  <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails list-gallery pt-2" data-ride="carousel"> 
                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                    
                      @foreach($gallery_images as $i => $gallery_img)

                      <div class="carousel-item @if($i==0) active @endif"> <img class="d-block w-100" src="{{ url('/'.$gallery_img->image) }}" alt="slide" title="gallery image"> </div>

                      @endforeach
 
                    </div>
                    <!--Controls starts--> 
                    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev" title="prev"> <span class="lnr lnr-arrow-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next" title="next"> <span class="lnr lnr-arrow-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> 
                    <!--Controls ends-->
                    <ol class="carousel-indicators list-gallery-thumb">
                      @foreach($gallery_images as $i => $gallery_img)
                      <li data-target="#carousel-thumb" data-slide-to="{{$i}}"><img class="img-fluid d-block w-100" src="{{ url('/'.$gallery_img->image) }}" alt="gallery image" title="gallery image"></li>
                      @endforeach
                       
                    </ol>
                  </div>
                  <!--/.Carousel Wrapper--> 
                </div>
                 
                <div class="list-details-section">
                    <h4>{{trans('words.property_details')}}</h4>
                    <ul class="property-info">
                      <li>{{trans('words.type')}} : <span>{{get_type_info($property_info->type_id,'type_name')}}</span></li>
                      <li>{{trans('words.purpose')}} : <span>{{$property_info->purpose}}</span></li>                       
                      <li>{{trans('words.bedrooms')}}: <span>{{$property_info->bedrooms}}</span></li>
                      <li>{{trans('words.bathrooms')}}: <span>{{$property_info->bathrooms}}</span></li>
                      <li>{{trans('words.area')}}: <span>{{$property_info->area}}</span></li>
                      <li>{{trans('words.furnishing')}}: <span>{{$property_info->furnishing}}</span></li>
                    </ul>                                   
                </div>
              @if($property_info->amenities)  
				      <div class="list-details-section">
                    <h4>{{trans('words.amenities')}}</h4>
                    <ul class="listing-features">
                      @foreach(explode(',',$property_info->amenities) as $amenities)
                      <li><i class="fa fa-angle-right"></i>{{$amenities}}</li>
                      @endforeach
                       
                    </ul>                  
                </div>
              @endif  
             
              @if($property_info->floor_plan_image)
              <div id="floor_plan" class="list-details-section">
                <h4>{{trans('words.floor_plan_image')}}</h4>
                <div id="carousel-thumb1" class="carousel slide carousel-fade carousel-thumbnails list-gallery pt-2" data-ride="carousel"> 
                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                      <div class="carousel-item active"> <img class="d-block w-100" src="{{ url('/'.$property_info->floor_plan_image) }}" alt="slide" title="floor plan"> </div>
                    </div>
                </div>
              </div>
              @endif

              </div>
            </div>
          </div>
		  
           
              
              @include("pages.sidebar_right")
           

        </div>
      </div>
    </div>
    <!--Listing Details Info ends--> 
	
    <!--Similar Listing starts-->
    <div class="similar-listing-wrap bg-white pb-30 pt-10 mt-10">
      <div class="container">
        <div class="col-md-12 px-0">
          <div class="similar-listing">
            <div class="section-title vfx2">
              <h2>{{trans('words.similar_properties')}}</h2>
            </div>
            <div class="swiper-container similar-list-wrap">
              <div class="swiper-wrapper">

              @foreach($related_list as $related)
                <div class="swiper-slide">
                  <div class="vfx-single-property-box-area">
                    <div class="vfx-property-item"> <a class="vfx-property-img" href="{{ URL::to('properties/'.$related->slug.'/'.$related->id) }}" title="{{stripslashes($related->title)}}"><img src="{{\URL::to('/'.$related->image)}}" alt="image" title="{{stripslashes($related->title)}}"> </a>
                      <ul class="vfx-feature-text">
                       @if($related->purpose=='Rent')
                          <li class="feature_cb"><span>{{trans('words.rent')}}</span></li>
                          @else
                          <li class="feature_or"><span>{{trans('words.sale')}}</span></li>
                          @endif
                          
                          @if($related->verified=='YES')
                          <li class="feature_cb verified_item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Verified"><i class="fa fa-check"></i></li>
                          @endif			     
                      </ul>
                                <div class="vfx-property-author-wrap"> 
                      <p class="text-tlt">{{get_type_info($related->type_id,'type_name')}}</p>
                      <ul class="vfx-save-btn">
                           
                          <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Favourite" class="favourite_property favourite_title_id{{$related->id}}" data-id="{{$related->id}}">
                            @if(check_favourite("Property",$related->id,isset(Auth::user()->id)?Auth::user()->id:""))
                            <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart favourite_icon_id{{$related->id}}"></i></a>
                            @else
                            <a href="Javascript:void(0);" title="fav"><i class="fa fa-heart-o favourite_icon_id{{$related->id}}"></i></a>
                            @endif
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="vfx-property-title-box-area">
                      <h4><a href="{{ URL::to('properties/'.$related->slug.'/'.$related->id) }}" title="{{stripslashes($related->title)}}">{{Str::limit(stripslashes($related->title),25)}}</a></h4>
                      <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
                        <p>
                            @if(get_location_info($related->location_id,'name')!="")
                              {{get_location_info($related->location_id,'name')}}
                            @else
                            {{Str::limit(stripslashes($related->address),40)}}
                            @endif
                        </p>
                      </div>
                      <div class="trending-bottom">
                      <div class="trend-left float-left">
                        <div class="vfx-property-author-wrap"> <a href="{{ URL::to('properties/owner/'.$related->user_id) }}" class="property-author" title="User"> 
                        @if(file_exists(URL::to('upload/'.get_user_info($related->user_id,'user_image'))))
                            <img src="{{\URL::to('upload/'.get_user_info($related->user_id,'user_image'))}}" alt="image" title="image user"> 
                          @else
                          <img src="{{\URL::to('site_assets/images/user-default.jpg')}}" alt="image" title="image user">
                          @endif    
                        <span>{{get_user_info($related->user_id,'name')}}</span> </a></div>
                      </div>
                      <a href="{{ URL::to('properties/'.$related->slug.'/'.$related->id) }}" class="vfx-trend-right float-right" title="{{stripslashes($related->title)}}">
                        <div class="vfx-trend-open-price">{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($related->price)}}</div>
                      </a> 
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

           
                
              </div>
            </div>
            <div class="slider-btn vfx2 similar-next"><i class="lnr lnr-arrow-right"></i></div>
            <div class="slider-btn vfx2 similar-prev"><i class="lnr lnr-arrow-left"></i></div>
          </div>
        </div>
      </div>


      @if(get_web_banner('details_bottom')!="")      
          <div class="add_banner_section pb-0">
            <div class="container">
              <div class="row">
                  <div class="col-md-12">
                  {!!stripslashes(get_web_banner('details_bottom'))!!}
                </div>
              </div>  
            </div>
          </div>
      @endif

    </div>
    <!--Similar Listing ends--> 
 

 </div>
</div>
<!--Page Wrapper ends-->


<!-- Reports Modal Starts -->
<div class="modal fade" id="vfx-report-popup">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<h5 class="modal-title text-dark">{{trans('words.reports_property')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="lnr lnr-cross"></i></span></button>
      </div>
      <div class="modal-body pl-0 pr-0"> 
         <div class="container">
             
         {{ html()->form('POST', url('/properties/report'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'report_form', 'name' => 'report_form', 'role' => 'form'])->open() }}
        
              
            <input type="hidden" name="property_id" value="{{ $property_info->id }}">
				<div class="form-control-wrap">
				  <div class="row">
					  <div class="col-lg-12 col-md-12">
						  <div class="form-group">
							<textarea class="form-control" rows="3" name="report_text" id="report_text" placeholder="{{trans('words.write_reason')}}"></textarea>
						  </div>
					  </div>
					  <div class="col-lg-12 col-md-12">
						  <div class="form-group mb-0">
							<button type="submit" class="btn vfx7 w-100">{{trans('words.submit')}}</button>
						  </div>
					  </div>
				  </div>
				</div>
        {{ html()->form()->close() }}
         </div>
      </div>
    </div>
  </div>
</div>
<!-- Reports Modal Ends -->

<!-- Social Media Modal Starts -->
<div class="modal fade" id="vfx-social-media-popup">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<h5 class="modal-title text-dark">Social Media</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="lnr lnr-cross"></i></span></button>
      </div>
      <div class="modal-body pt-4 pb-4"> 
        <div class="vfx-user-login-section">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                 <ul class="vfx-social-button style1 text-center">
					  <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" target="_blank" title="facebook"><i class="fa fa-facebook-f"></i></a></li>
					  <li><a href="https://twitter.com/intent/tweet?text={{$property_info->title}}&amp;url={{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a></li>
					  <li><a href="https://wa.me?text={{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" target="_blank" title="whatsapp"><i class="fa fa-whatsapp"></i></a></li>
					  <li><a href="https://www.instagram.com/?url={{ URL::to('properties/'.$property_info->slug.'/'.$property_info->id) }}" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a></li>
				  </ul> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Social Media Modal Ends -->

<script type="text/javascript">
    
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

  @if (count($errors) > 0)
                  
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: '<p>@foreach ($errors->all() as $error) {{$error}}<br/> @endforeach</p>',
            showConfirmButton: true,
            confirmButtonColor: '#10c469',
            background:"#1a2234",
            color:"#fff"
           }) 
  @endif

  </script>
 
@endsection