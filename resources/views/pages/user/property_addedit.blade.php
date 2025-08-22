@extends('site_app')

@section('head_title', isset($info->id) ? trans('words.edit_property') : trans('words.add_property').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')

<link href="{{ URL::asset('site_assets/js/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />

<script src="{{ URL::asset('site_assets/js/tinymce/tinymce.min.js') }}"></script>
 

  <!--Breadcrumb section starts-->
  <div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumb-menu">
            <h2>{{ isset($info->id) ? trans('words.edit_property') : trans('words.add_property')}} </h2>
            <span><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></span> <span>{{ isset($info->id) ? trans('words.edit_property') : trans('words.add_property')}}</span></div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

 <!--Add Property section starts-->
 <div class="about-section pt-30 pb-20">
    <div class="container">
      <div class="row">
         <div class="col-lg-10 col-md-10 m-auto">
	     {{ html()->form('POST', url('/user/property/add_edit'))
                     ->attributes(['class' => '', 'id' => 'property_form', 'name' => 'property_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open() }}
 

		 <input type="hidden" name="id" value="{{ isset($info->id) ? $info->id : null }}">

				<div class="vfx-dashboard-add-list-wrap">
					<div class="vfx-act-title">
						<h5>{{trans('words.general_information')}} :</h5>
					</div>
					<div class="vfx-dashboard-add-listing">
						<div class="row">
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<label>{{trans('words.type')}} *</label>
								<select class="listing-input vfx_hero_form_area_input vfx-custom-select-area" name="type" id="type_id">   
									<option value="">{{trans('words.select_type')}}</option>                            
									@foreach($type_list as $type_data)  
										<option value="{{$type_data->id}}" @if(isset($info->id) AND $type_data->id==$info->type_id) selected @endif>{{$type_data->type_name}}</option>
									@endforeach   
								</select>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<label>{{trans('words.purpose')}}</label>
								 <select class="listing-input vfx_hero_form_area_input vfx-custom-select-area" name="purpose" id="purpose">                               
									<option value="Sale" @if(isset($info->purpose) AND $info->purpose=="Sale") selected @endif>Sale</option>
									<option value="Rent" @if(isset($info->purpose) AND $info->purpose=="Rent") selected @endif>Rent</option>
								 </select>
 							</div>
							<div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.property_title')}} *</label>
									<input type="text" name="title" class="form-control filter-input" value="{{ isset($info->title) ? stripslashes($info->title) : null }}">
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.description')}} </label>
									<textarea id="description" name="description" class="elm1_editor form-control filter-input">{{ isset($info->description) ? stripslashes($info->description) : null }}</textarea>
								</div>
							</div>
							<div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.phone')}}</label>
									<input type="text" name="phone" class="form-control filter-input" value="{{ isset($info->phone) ? $info->phone : null }}">
								</div>
							</div>
							<div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.location_text')}} *</label>
									<select class="listing-input vfx_hero_form_area_input vfx-custom-select-area" name="location" id="location">   
										<option value="">{{trans('words.select_location')}}</option>                            
										@foreach($location_list as $location_data)  
											<option value="{{$location_data->id}}" @if(isset($info->id) AND $location_data->id==$info->location_id) selected @endif>{{$location_data->name}}</option>
										@endforeach   
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.address')}}</label>
									<textarea id="elm1" name="address" class="form-control filter-input">{{ isset($info->address) ? stripslashes($info->address) : null }}</textarea>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.longitude')}} <span><a href="http://www.latlong.net" target="_blank">Find Here!</a></span></label>
									<input type="text" name="latitude" value="{{ isset($info->latitude) ? stripslashes($info->latitude) : null }}" class="form-control filter-input" placeholder="Latitude"> 
								</div>								 
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.longitude')}} </label>
									<input type="text" name="longitude" value="{{ isset($info->longitude) ? stripslashes($info->longitude) : null }}" class="form-control filter-input" placeholder="Longitude"> 
								</div>								 
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
								<div class="vfx-act-title mt-15">
									<h5>Overview</h5>
								</div>
							</div>
							
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.bedrooms')}}</label>
									<input type="text" class="form-control filter-input" name="bedrooms" value="{{ isset($info->bedrooms) ? stripslashes($info->bedrooms) : null }}">
								</div>
							</div>

							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.bathrooms')}}</label>
									<input type="text" class="form-control filter-input" name="bathrooms" value="{{ isset($info->bathrooms) ? stripslashes($info->bathrooms) : null }}">
								</div>
							</div>

							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.area')}}</label>
									<input type="text" class="form-control filter-input" name="area" value="{{ isset($info->area) ? stripslashes($info->area) : null }}">
								</div>
							</div>

							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.furnishing')}}</label>
									<select class="listing-input vfx_hero_form_area_input vfx-custom-select-area" name="furnishing" id="furnishing">                               
										<option value="Unfurnished" @if(isset($info->furnishing) AND $info->furnishing=="Unfurnished") selected @endif>Unfurnished</option>
										<option value="Semi-Furnished" @if(isset($info->furnishing) AND $info->furnishing=="Semi-Furnished") selected @endif>Semi-Furnished</option>
										<option value="Furnished" @if(isset($info->furnishing) AND $info->furnishing=="Furnished") selected @endif>Furnished</option>
									</select> 
								</div>
							</div>

							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<label>{{trans('words.price')}}</label>
								<input type="text" class="form-control filter-input" name="price" value="{{ isset($info->price) ? $info->price : null }}">
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="form-group">
									<label>{{trans('words.verified')}}</label>
									<select class="listing-input vfx_hero_form_area_input vfx-custom-select-area" name="verified">
										<option value="NO" @if(isset($info->verified) AND $info->verified=="NO") selected @endif>{{trans('words.no')}}</option>                                                           
										<option value="YES" @if(isset($info->verified) AND $info->verified=="YES") selected @endif>{{trans('words.yes')}}</option>                                
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 col-12">
								<div class="tagsinput_item">
									<label>{{trans('words.amenities')}}</label>
									<input type="text" class="form-control filter-input" name="amenities" value="{{ isset($info->amenities) ? stripslashes($info->amenities) : null }}" data-role="tagsinput">
								</div>
							</div>
							  
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
								<label>{{trans('words.featured_image')}} * <span>({{trans('words.recommended_resolution')}} : 800x480, 600x350)</span></label>
								<div class="fileupload_block">
									<input type="file" name="image" onchange="readURL(this);" id="fileupload" value="{{ isset($info->image) ? stripslashes($info->image) : null }}">
									<div class="fileupload_img">
									
									@if(isset($info->image)) 
									<img src="{{URL::to('/'.$info->image)}}" style="width:150px;height:100px" id="pro_featured_image" alt="landscape">	
									@else
									<img src="{{URL::to('/site_assets/images/landscape.jpg')}}" style="width:150px;height:100px" id="pro_featured_image" alt="landscape">
									@endif
 
									</div>
								</div>									 
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
								<label>{{trans('words.floor_plan_image')}} <span>({{trans('words.recommended_resolution')}} : 800x480, 600x350)</span></label>
								<div class="fileupload_block">
									<input type="file" name="floor_plan_image" onchange="readURLFloor(this);" value="{{ isset($info->floor_plan_image) ? stripslashes($info->floor_plan_image) : null }}">
									<div class="fileupload_img">
									@if(isset($info->floor_plan_image)) 
									<img src="{{URL::to('/'.$info->floor_plan_image)}}" style="width:150px;height:100px" id="pro_floor_plan" alt="landscape">	
									@else
									<img src="{{URL::to('/site_assets/images/landscape.jpg')}}" style="width:150px;height:100px" id="pro_floor_plan" alt="landscape">
									@endif 
										
									</div> 
								</div>									 
							</div> 
							
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
							<div class="vfx-act-title mt-15">
								<h5>{{trans('words.gallery_images')}}</h5>
							</div>
						</div>

						@if(isset($info->id))
						<div class="gallery_item col-md-12 mb-15">	
							<div class="row">
								@foreach($gallery_images as $i => $gallery_img)
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 col-6 gallery_block" id="gallery_box{{$gallery_img->id}}">
									<span title="Delete" class="gall_delete_img">
									<a href="#" class="image_remove" data-toggle="tooltip" title="{{trans('words.remove')}}" data-id="{{$gallery_img->id}}"> <i class="fa fa-remove"></i> </a>
									</span>
									<img src="{{ url('/'.$gallery_img->image) }}" class="img-thumbnail" alt="gallery" width="140">
								</div> 
								@endforeach        
										
							</div>
						</div>	
							
						<br/>
						@endif 
						 
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
								<label>{{trans('words.image')}} 1</label>
								<div class="fileupload_block">
									<input type="file" name="image_gallery[]">								 
								</div>									 
							</div>
							
							<div id="dynamicInput"></div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
								<button type="button" class="btn btn-success btn-xs" onClick="addInput('dynamicInput');">{{trans('words.add_more_image')}}</button>
							</div>
							 
							<div class="col-md-12 text-right sm-left">
								<button class="btn vfx3" type="submit">{{trans('words.submit')}}</button>
							</div>
						</div>
					</div>
				</div>
				 
				  
				{{ html()->form()->close() }}
         </div>
      </div>
    </div>
  </div>
  <!--Add Property section ends--> 

 
  
<!-- Scroll to top starts--> 
<span class="vfx-scroll-top-btn"><i class="lnr lnr-arrow-up"></i></span> 
<!-- Scroll to top ends--> 
</div>
<!--Page Wrapper ends--> 
 
<script src="{{ URL::asset('site_assets/js/jquery.min.js') }}"></script>

<script src="{{ URL::asset('site_assets/js/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">
$(document).ready(function () {	
  'use strict';	
  if ($(".elm1_editor").length > 0) {
	tinymce.init({
	  selector: "textarea.elm1_editor",           
	  height: 300,
	  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
	   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor",
	  style_formats: [
		{ title: 'Bold text', inline: 'b' },
		{ title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
		{ title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
		{ title: 'Example 1', inline: 'span', classes: 'example1' },
		{ title: 'Example 2', inline: 'span', classes: 'example2' },
		{ title: 'Table styles' },
		{ title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
	  ]
	});
  }
});
</script>

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

<script>
function readURL(input) {
	'use strict';
	if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function(e) {
		 $("#pro_featured_image").attr('src', e.target.result);
	}

	reader.readAsDataURL(input.files[0]);
	}
}
function readURLFloor(input) {
	'use strict';
	if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function(e) {
		 $("#pro_floor_plan").attr('src', e.target.result);
	}

	reader.readAsDataURL(input.files[0]);
	}
}
</script>

<script type="text/javascript">
// JavaScript Document
'use strict';
var counter = 1;
var limit = 50;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');

		  newdiv.className = "col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12";

          var wall_number=counter+1;

          newdiv.innerHTML ='<label>{{trans('words.image')}} '+wall_number+'</label><div class="fileupload_block"><input type="file" name="image_gallery[]"></div>';
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}

</script>

<script type="text/javascript">
  //Single   
  $(".image_remove").on('click', function () {      	
  'use strict';	
  
  var post_id = $(this).data("id");
  var action_name='gallery_img_delete';

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

                  var selector = "#gallery_box"+post_id;
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