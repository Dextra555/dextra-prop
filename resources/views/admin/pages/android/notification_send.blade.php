@extends("admin.admin_app")

@section("content")

 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                 
              {{ html()->form('POST', url('/admin/notification_send'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'settings_form', 'name' => 'settings_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open() }}
 
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.title')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="notification_title" value="" class="form-control">
                    </div>
                  </div>
  
                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.android_notification_message')}}*</label>
                    <div class="col-sm-8">
                       
                      <textarea id="notification_msg" name="notification_msg" class="form-control"></textarea>
                     
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.image')}} <small id="emailHelp" class="form-text text-muted">({{trans('words.optional')}})</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="notification_image" id="notification_image" value="" class="form-control" readonly>                         
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="notification_image" data-preview="holder_thumb" data-inputid="notification_image">Select</button>                        
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">( {{trans('words.recommended_resolution')}}: 600x293 or 650x317 or 700x342 or 750x366)</small>
                      <div id="image_holder" class="send_notification_img"></div>                     
                    </div>
                  </div>       
                  <h4 class="m-t-0 m-b-30 header-title" style="font-size: 18px;">{{trans('words.or')}}</h4>

                   

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.type_text')}} <small id="emailHelp" class="form-text text-muted">({{trans('words.optional')}})</small></label> 
                      <div class="col-sm-8">
                            <select name="type_id" class="select2" id="type_id1" data-placeholder="{{trans('words.select_type')}}...">   
                                 <option value="" >{{trans('words.select_type')}}</option>

                                 @foreach($type_list as $type_data)
                                  <option value="{{$type_data->id}}" @if(isset($info->id) && in_array($type_data->id, explode(",",$info->post_ids))) selected @endif>{{$type_data->type_name}}</option>
                                @endforeach
                            </select>
                            <small id="emailHelp" class="form-text text-muted">(To directly open type post when click on notification)</small>
                      </div>
                  </div>

                  

                  <h4 class="m-t-0 m-b-30 header-title" style="font-size: 18px;">{{trans('words.or')}}</h4>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.android_external_link')}} <small id="emailHelp" class="form-text text-muted">({{trans('words.optional')}})</small></label>
                    <div class="col-sm-8">
                      <input type="text" name="external_link" value="" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-send"></i> {{trans('words.send')}} </button>                      
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

    if(requestingField=="notification_image")
    {
      var target_preview = $('#image_holder');
      target_preview.html('');
      target_preview.append(
              $('<img class="noti_preview_img">').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
            );
      target_preview.trigger('change');
    }
     
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

@endsection