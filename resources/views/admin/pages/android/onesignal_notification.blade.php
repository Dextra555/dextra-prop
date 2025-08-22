@extends("admin.admin_app")

@section("content")
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                 
                 {{ html()->form('POST', url('/admin/onesignal_notification'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'settings_form', 'name' => 'settings_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open() }}
 
                  
                  <input type="hidden" name="id" value="{{ isset($settings->id) ? $settings->id : null }}">
   
  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">OneSignal App ID *</label>
                    <div class="col-sm-8">
                      <input type="text" name="onesignal_app_id" value="{{ isset($settings->onesignal_app_id) ? $settings->onesignal_app_id : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">OneSignal Rest Key *</label>
                    <div class="col-sm-8">
                      <input type="text" name="onesignal_rest_key" value="{{ isset($settings->onesignal_rest_key) ? $settings->onesignal_rest_key : null }}" class="form-control">
                    </div>
                  </div> 
                    
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> {{trans('words.save_settings')}} </button>                      
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