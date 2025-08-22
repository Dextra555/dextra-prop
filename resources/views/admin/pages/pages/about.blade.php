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
                      <a href="{{ URL::to('admin/pages') }}"><h4 class="header-title m-t-0 m-b-30 text-primary pull-left" style="font-size: 20px;"><i class="fa fa-arrow-left"></i> {{trans('words.back')}}</h4></a>
                 </div>
                 @if(isset($page_info->id))
                 <div class="col-sm-6">
                    <a href="{{ URL::to('page/'.$page_info->id.'/'.$page_info->page_slug) }}" target="_blank"><h4 class="header-title m-t-0 m-b-30 text-primary pull-right" style="font-size: 20px;">{{trans('words.preview')}} <i class="fa fa-eye"></i></h4> </a>
                 </div>
                 @endif
               </div> 
                 
               {{ html()->form('POST', url('/admin/pages/about_update'))
                     ->attributes(['class' => 'form-horizontal', 'id' => 'post_form', 'name' => 'post_form', 'role' => 'form', 'enctype' => 'multipart/form-data'])->open() }}
 
                  
                  <input type="hidden" name="id" value="{{ isset($page_info->id) ? $page_info->id : null }}">
  
                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.title')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="page_title" value="{{ isset($page_info->page_title) ? stripslashes($page_info->page_title) : null }}" class="form-control">
                    </div>
                  </div>
  
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.about_text_1')}}</label>
                    <div class="col-sm-8">
                      <textarea id="page_content" name="page_content" class="form-control elm1_editor">{{ isset($page_info->page_content) ? stripslashes($page_info->page_content) : null }}</textarea>
                       
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.about_image_1')}}</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="page_about_image" id="page_about_image" value="{{ isset($page_info->page_about_image) ? $page_info->page_about_image : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="page_about_image" data-preview="holder_logo" data-inputid="page_about_image">Select</button>                        
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">({{trans('words.recommended_resolution')}} : 300x200, 400x260, 600x400 or etc)</small>
                      <div id="page_about_image_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>

                  @if(isset($page_info->page_about_image)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="{{URL::to('/'.$page_info->page_about_image)}}" alt="video image" class="img-thumbnail" width="140">                                               
                    </div>
                  </div>
                  @endif

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.about_text_2')}}</label>
                    <div class="col-sm-8">
                      <textarea id="page_about_text2" name="page_about_text2" class="form-control elm1_editor">{{ isset($page_info->page_about_text2) ? stripslashes($page_info->page_about_text2) : null }}</textarea>
                       
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.about_image_2')}}</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="page_about_image2" id="page_about_image2" value="{{ isset($page_info->page_about_image2) ? $page_info->page_about_image2 : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="page_about_image2" data-preview="holder_logo" data-inputid="page_about_image2">Select</button>                        
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">({{trans('words.recommended_resolution')}} : 300x200, 400x260, 600x400 or etc)</small>
                      <div id="page_about_image2_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>

                  @if(isset($page_info->page_about_image2)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="{{URL::to('/'.$page_info->page_about_image2)}}" alt="video image" class="img-thumbnail" width="140">                                               
                    </div>
                  </div>
                  @endif
                   
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.page_position')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="page_position">                               
                                <option value="Top" @if(isset($page_info->page_position) AND $page_info->page_position=='Top') selected @endif>Top</option>
                                <option value="Bottom" @if(isset($page_info->page_position) AND $page_info->page_position=='Bottom') selected @endif>Bottom</option>                            
                            </select>
                      </div>
                  </div>
                  
                 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.page_order')}}</label>
                    <div class="col-sm-8">
                      <input type="number" name="page_order" value="{{ isset($page_info->page_order) ? stripslashes($page_info->page_order) : null }}" class="form-control" min="0">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.status')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" @if(isset($page_info->status) AND $page_info->status==1) selected @endif>{{trans('words.active')}}</option>
                                <option value="0" @if(isset($page_info->status) AND $page_info->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
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
  
@endsection