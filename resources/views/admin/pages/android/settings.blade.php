@extends("admin.admin_app")

@section("content")
 
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">

              <div class="row">

                <div class="col-md-10">

                {{ html()->form('POST', url('/admin/android_settings'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'settings_form', 'name' => 'settings_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open() }}
                   
                  
                 <input type="hidden" name="id" value="{{ isset($settings->id) ? $settings->id : null }}">
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.app_name')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="app_name" value="{{ isset($settings->app_name) ? stripslashes($settings->app_name) : null }}" class="form-control">
                    </div>
                  </div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.app_logo')}}*</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="app_logo" id="app_logo" value="{{ isset($settings->app_logo) ? $settings->app_logo : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="app_logo" data-preview="holder_logo" data-inputid="app_logo">Select</button>                        
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">({{trans('words.recommended_resolution')}} : 150x150)</small>
                      <div id="site_logo_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>                 

                  @if(isset($settings->app_logo)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="{{URL::to('/'.$settings->app_logo)}}" alt="video image" class="img-thumbnail" width="120">                                               
                    </div>
                  </div>
                  @endif
                   
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.email')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="app_email" value="{{ isset($settings->app_email) ? $settings->app_email : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.app_company')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="app_company" value="{{ isset($settings->app_company) ? $settings->app_company : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.app_website')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="app_website" value="{{ isset($settings->app_website) ? $settings->app_website : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.app_contact')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="app_contact" value="{{ isset($settings->app_contact) ? $settings->app_contact : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.app_version')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="app_version" value="{{ isset($settings->app_version) ? $settings->app_version : null }}" class="form-control">
                    </div>
                  </div>
                  
                 
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> {{trans('words.save_settings')}} </button>                      
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
        </div>
      </div>
      @include("admin.copyright") 
    </div> 
 
  
<script type="text/javascript">
     
     
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {

   'use strict';

    var elfinderUrl = "{{ URL::to('/') }}/";

    if(requestingField=="app_logo")
    {
      var target_preview = $('#app_logo_holder');
      target_preview.html('');
      target_preview.append(
              $('<img>').css('height', '5rem').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
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