@extends("admin.admin_app")

@section("content")

 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                 <div class="row">
                 <div class="col-sm-6">
                      <a href="{{ URL::to('admin/property') }}"><h4 class="header-title m-t-0 m-b-30 text-primary pull-left" style="font-size: 20px;"><i class="fa fa-arrow-left"></i> {{trans('words.back')}}</h4></a>
                 </div>                  
               </div>  
               
               {{ html()->form('POST', url('/admin/property/add_edit'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open() }}
 
                  
                 <input type="hidden" name="id" value="{{ isset($info->id) ? $info->id : null }}">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.type')}}*</label>
                      <div class="col-sm-3">
                            <select class="form-control select2" name="type" id="type">   
                               <option value="">{{trans('words.select_type')}}</option>                            
                              @foreach($type_list as $type_data)  
                                <option value="{{$type_data->id}}" @if(isset($info->id) AND $type_data->id==$info->type_id) selected @endif>{{$type_data->type_name}}</option>
                              @endforeach   
                            </select>
                      </div>

                      <label class="col-sm-2 col-form-label">{{trans('words.purpose')}}</label>
                      <div class="col-sm-3">
                            <select class="form-control" name="purpose" id="purpose">                               
                                <option value="Sale" @if(isset($info->purpose) AND $info->purpose=="Sale") selected @endif>Sale</option>
                                <option value="Rent" @if(isset($info->purpose) AND $info->purpose=="Rent") selected @endif>Rent</option>
                                                   
                            </select>
                      </div>
                  </div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.property_title')}}*  </label>
                    <div class="col-sm-8">
                      <input type="text" name="title" value="{{ isset($info->title) ? stripslashes($info->title) : old('title') }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.description')}}</label>
                    <div class="col-sm-8">
                    <textarea id="elm1" name="description" class="form-control">{{ isset($info->description) ? stripslashes($info->description) : null }}</textarea>
                    </div>
                  </div><br/>
                   

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.phone')}}</label>
                    <div class="col-sm-3">
                      <input type="text" name="phone" value="{{ isset($info->phone) ? $info->phone : null }}" class="form-control">
                    </div>

                    <label class="col-sm-2 col-form-label">{{trans('words.location_text')}} *</label>
                      <div class="col-sm-3">
                            <select class="form-control select2" name="location" id="location">   
                               <option value="">{{trans('words.select_location')}}</option>                            
                              @foreach($location_list as $location_data)  
                                <option value="{{$location_data->id}}" @if(isset($info->id) AND $location_data->id==$info->location_id) selected @endif>{{$location_data->name}}</option>
                              @endforeach   
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.address')}} </label>
                    <div class="col-sm-8">
                      <input type="text" name="address" value="{{ isset($info->address) ? stripslashes($info->address) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.lat_long')}}

                    <small class="form-text text-muted">(Get Latitude and Longitude <a href="https://www.latlong.net" target="_blank">Here!</a>)</small> 
                    </label>
                    <div class="col-sm-4">
                      <input type="text" name="latitude" value="{{ isset($info->latitude) ? stripslashes($info->latitude) : null }}" class="form-control" placeholder="Latitude">
                    </div>
                    <div class="col-sm-4">
                    <input type="text" name="longitude" value="{{ isset($info->longitude) ? stripslashes($info->longitude) : null }}" class="form-control" placeholder="Longitude">    
                    </div>
                    
                  </div>

                  <hr/>
                  <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;">Overview</h4>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.bedrooms')}}                    
                    </label>
                    <div class="col-sm-3">
                      <input type="text" name="bedrooms" value="{{ isset($info->bedrooms) ? stripslashes($info->bedrooms) : null }}" class="form-control">
                    </div>
                    <label class="col-sm-2 col-form-label">{{trans('words.bathrooms')}}                    
                    </label>
                    <div class="col-sm-3">
                    <input type="text" name="bathrooms" value="{{ isset($info->bathrooms) ? stripslashes($info->bathrooms) : null }}" class="form-control">    
                    </div>
                    
                  </div>    

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.area')}}                    
                    </label>
                    <div class="col-sm-3">
                          <input type="text" name="area" value="{{ isset($info->area) ? stripslashes($info->area) : null }}" class="form-control">
                    </div>
                    <label class="col-sm-2 col-form-label">{{trans('words.furnishing')}}                    
                    </label>
                    <div class="col-sm-3">
                    <select class="form-control" name="furnishing" id="furnishing">                               
                                <option value="Unfurnished" @if(isset($info->furnishing) AND $info->furnishing=="Unfurnished") selected @endif>Unfurnished</option>
                                <option value="Semi-Furnished" @if(isset($info->furnishing) AND $info->furnishing=="Semi-Furnished") selected @endif>Semi-Furnished</option>
                                <option value="Furnished" @if(isset($info->furnishing) AND $info->furnishing=="Furnished") selected @endif>Furnished</option>
                                                   
                            </select>    
                    </div>
                    
                  </div>
  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.price')}}                    
                    </label>
                    <div class="col-sm-3">
                          <input type="number" name="price" value="{{ isset($info->price) ? $info->price : null }}" class="form-control" min="1" step="1">
                    </div>
                    <label class="col-sm-2 col-form-label">{{trans('words.verified')}}                    
                    </label>
                    <div class="col-sm-3">
                            <select class="form-control" name="verified">
                                <option value="NO" @if(isset($info->verified) AND $info->verified=="NO") selected @endif>{{trans('words.no')}}</option>                                                           
                                <option value="YES" @if(isset($info->verified) AND $info->verified=="YES") selected @endif>{{trans('words.yes')}}</option>                                
                            </select>   
                    </div>
                    
                  </div>
                  
                  <div class="form-group row">                   
                    <label class="col-sm-3 col-form-label">{{trans('words.amenities')}}</label>
                    <div class="col-sm-8">
                        <input type="text" name="amenities" value="{{ isset($info->amenities) ? stripslashes($info->amenities) : null }}" class="form-control" data-role="tagsinput">
                    </div>
                  </div>                    

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.featured_image')}}*</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="image" id="image" value="{{ isset($info->image) ? stripslashes($info->image) : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="image" data-preview="holder_logo" data-inputid="image">Select</button>                        
                        </div>
                      </div>
                      <small class="form-text text-muted">({{trans('words.recommended_resolution')}} : 800x480, 600x350)</small> 

                      <div id="image_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>
                
                  @if(isset($info->image)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="{{URL::to('/'.$info->image)}}" alt="image" class="img-thumbnail" width="140">                                               
                    </div>
                  </div>
                  @endif  

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.floor_plan_image')}}</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="floor_plan_image" id="floor_plan_image" value="{{ isset($info->floor_plan_image) ? stripslashes($info->floor_plan_image) : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="floor_plan_image" data-preview="holder_logo" data-inputid="floor_plan_image">Select</button>                        
                        </div>
                      </div>
                      <small class="form-text text-muted">({{trans('words.recommended_resolution')}} : 800x480, 600x350)</small> 

                      <div id="floor_plan_image_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>
                
                  @if(isset($info->floor_plan_image)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="{{URL::to('/'.$info->floor_plan_image)}}" alt="image" class="img-thumbnail" width="140">                                               
                    </div>
                  </div>
                  @endif 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.gallery_images')}}</label>
                    <div class="col-sm-8">
                    
                    @if(isset($info->id))
                      <div class="row">
                        @foreach($gallery_images as $i => $gallery_img)
                          <div class="col-md-6 col-xl-3 col-lg-4 gallery_block" id="gallery_box{{$gallery_img->id}}">
                                      
                                      <span title="Delete" class="gall_delete_img">
                                      <a href="#" class="image_remove" data-toggle="tooltip" title="{{trans('words.remove')}}" data-id="{{$gallery_img->id}}"> <i class="fa fa-remove"></i> </a>
                                      </span>
                                      <img src="{{ url('/'.$gallery_img->image) }}" class="img-thumbnail" alt="gallery" width="140">
                                   
                               
                          </div> 
                        @endforeach        
                                 
                      </div>  
                        
                      <br/>
                    @endif 
                       
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{trans('words.image')}} 1</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <input type="text" name="image_gallery[]" id="image1" value="" class="form-control" readonly>
                          <div class="input-group-append">                           
                            <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="image" data-preview="holder_logo" data-inputid="image1">Select</button>                        
                          </div>
                        </div>
                          
                        <div id="image1_holder" class="gallery_img_item" style="margin-top:5px;max-height:100px;"></div>                     
                      </div>
                    </div>

                    <div id="dynamicInput"></div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">&nbsp;</label>
                      <div class="col-sm-10">
                      <button type="button" class="btn btn-success btn-xs" onClick="addInput('dynamicInput');">{{trans('words.add_more_image')}}</button>
                      </div>
                    </div>
                       

                     </div>
                  </div>
 
                  
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.status')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" @if(isset($info->status) AND $info->status==1) selected @endif>{{trans('words.active')}}</option>
                                <option value="0" @if(isset($info->status) AND $info->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
                            </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> {{trans('words.save')}}</button>                      
                    </div>
                  </div>
                  {{ html()->form()->close() }}
              </div>
            </div>            
          </div>              
        </div>
      </div>

      @include("admin.copyright") 
    
    </div>  

<script type="text/javascript">
    
     
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
   
  'use strict';    

    var elfinderUrl = "{{ URL::to('/') }}/";
     
      var target_preview = $('#'+requestingField+'_holder');
      target_preview.html('');
      target_preview.append(
              $('<img>').css('height', '5rem').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
            );
      target_preview.trigger('change');
     
    $('#' + requestingField).val(filePath.replace(/\\/g,"/")).trigger('change');
 
}
 
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

<script src="{{ URL::asset('admin_assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(e) {

    'use strict';    
       
    $("#news_type").change(function(){         
        var type=$("#news_type").val();

        if(type=="Image")
        {   
            $("#gallery_section").show();
            $("#video_section").hide();
        }         
        else
        {
            $("#gallery_section").hide();
            $("#video_section").show();
            $("#url_id_sec").hide();
        }

    });  

    $("#news_video_type").change(function(){         
        var video_type=$("#news_video_type").val();

        if(video_type=="Local")
        {   
            $("#local_id_sec").show();
            $("#url_id_sec").hide();
        }         
        else
        {
            $("#local_id_sec").hide();
            $("#url_id_sec").show();
        }

    }); 

  });
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

          var wall_number=counter+1;

          newdiv.innerHTML ='<div class="form-group row"><label class="col-sm-2 col-form-label">{{trans('words.image')}} '+wall_number+'</label><div class="col-sm-10"><div class="input-group"><input type="text" name="image_gallery[]" id="image'+wall_number+'" value="" class="form-control" readonly><div class="input-group-append"><button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="image" data-preview="holder_logo'+wall_number+'" data-inputid="image'+wall_number+'">Select</button></div></div><div id="image'+wall_number+'_holder" style="margin-top:5px;max-height:100px;"></div></div></div>';
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

  //alert(post_id);

  //alert(JSON.stringify(result));

    if(result.isConfirmed) { 

        $.ajax({
            type: 'post',
            url: "{{ URL::to('admin/ajax_delete') }}",
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