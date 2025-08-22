@extends("admin.admin_app")

@section("content")
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                 
              {{ html()->form('POST', url('/admin/others_settings'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'settings_form', 'name' => 'settings_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open() }}
 
                  
                  <input type="hidden" name="id" value="{{ isset($settings->id) ? $settings->id : null }}">
    
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.pagination_limit')}}</label>
                    <div class="col-sm-8">
                      <input type="number" name="pagination_limit" value="{{ isset($settings->pagination_limit) ? $settings->pagination_limit : null }}" class="form-control" placeholder="10" min="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.latest_limit')}}</label>
                    <div class="col-sm-8">
                      <input type="number" name="latest_limit" value="{{ isset($settings->latest_limit) ? $settings->latest_limit : null }}" class="form-control" placeholder="10" min="10">
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