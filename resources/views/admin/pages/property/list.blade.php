@extends("admin.admin_app")

@section("content")
 
  
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card-box table-responsive">
              <div class="row">   
                  <div class="wall-filter-block">  
                    <div class="row" style="align-items: center;justify-content: space-between;">             
                      <div class="col-sm-2">
						 <a href="{{URL::to('admin/property/add')}}" class="btn btn-success btn-md waves-effect waves-light mb-2 mt-2" data-toggle="tooltip" title="{{trans('words.add_property')}}">{{trans('words.add_property')}}</a>
                      </div>
					           <div class="col-sm-2">
                        <select class="form-control select2" name="type_id" id="type_id">
                          <option value="?type_id=">{{trans('words.type_text')}}</option>
                            @foreach($type_list as $type_data)
                            <option value="?type_id={{$type_data->id}}" @if(isset($_GET['type_id']) AND $_GET['type_id']==$type_data->id) selected @endif>{{$type_data->type_name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control select2" name="location_id" id="location_id">
                          <option value="?location_id=">{{trans('words.all_location')}}</option>
                            @foreach($location_list as $location_data)
                            <option value="?location_id={{$location_data->id}}" @if(isset($_GET['location_id']) AND $_GET['location_id']==$location_data->id) selected @endif>{{$location_data->name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-md-3">
                           
                          {{ html()->form('GET', url('/admin/property'))
                     ->attributes(['class' => 'app-search', 'id' => 'search'])->open() }}   
                            <input type="text" name="s" placeholder="{{trans('words.search_by_title')}}" class="form-control">
                            <button type="submit"><i class="fa fa-search"></i></button>
                            {{ html()->form()->close() }}
                      </div>
					  <div class="col-sm-3">
                        <div class="checkbox checkbox-success pull-right">
                            <input id="sellect_all" type="checkbox" name="sellect_all">
                            <label for="sellect_all">{{trans('words.select_all')}}</label>
                            &nbsp;&nbsp;
                            
                            <div class="btn-group">

                            <a href="javascript:void(0);" class="btn btn-info btn-md waves-effect waves-light mb-2 mt-2" data-toggle="tooltip" title="{{trans('words.delete')}}" data-action="delete" id="data_remove_selected">{{trans('words.delete')}}</a>

                                 
                            </div>
                        </div>
                      </div>
                    </div> 
                  </div>                
                </div>

                <br/>

                <div class="row">
                  @foreach($list as $i => $data)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" id="card_box_id_{{$data->id}}">

                        <!-- Simple card -->
                        <div class="card m-b-20">
                            <div class="wall-list-item">
                              <div class="checkbox checkbox-success wall_check">
                                <input type="checkbox" name="post_ids[]" id="checkbox<?php echo $i; ?>" value="<?php echo $data->id; ?>" class="post_ids">
                                <label for="checkbox<?php echo $i; ?>"></label>
                              </div>  
                              <div class="d-flex wall_preview_item view_item_block">
                                  <ul>                                      
                                    <li><a href="javascript:void(0)" data-toggle="tooltip" title="{{post_views_count($data->id,"Property")}} {{trans('words.views')}}"><i class="fa fa-eye"></i></a></li>                                                
                                  </ul>
                              </div>
                              <p class="wall_sub_text">{{ $data->types->type_name }}</p>
                              <div class="d-flex position-absolute" style="top: 4px;right: 15px;"></div>
                              @if(isset($data->image)) <img class="card-img-top thumb-lg img-fluid" src="{{URL::to('/'.$data->image)}}" alt=""> @endif
                            </div>
 
                            <div class="card-body p-3">
                                <span class="by_user_lg">By {{ $data->users->name }} </span>
                                <h4 class="card-title mb-3">{{ Str::limit(stripslashes($data->title),40) }}</h4>
                                <a href="{{ url('admin/property/edit/'.$data->id) }}" class="btn btn-icon waves-effect waves-light btn-success m-r-5" data-toggle="tooltip" title="{{trans('words.edit')}}"> <i class="fa fa-edit"></i> </a>
                                <a href="#" class="btn btn-icon waves-effect waves-light btn-danger data_remove" data-toggle="tooltip" title="{{trans('words.remove')}}" data-id="{{$data->id}}"> <i class="fa fa-remove"></i> </a>
                                <a class="ml-2" href="Javascript:void(0);" data-toggle="tooltip" title="@if($data->status==1){{ trans('words.active')}} @else {{trans('words.inactive')}} @endif"><input type="checkbox" name="category_on_off" id="category_on_off" value="1" data-plugin="switchery" data-color="#28a745" data-size="small" class="enable_disable"  data-id="{{$data->id}}" @if($data->status==1) {{ 'checked' }} @endif/></a>    
                            </div>
                        </div>

                    </div>
                   @endforeach      

                </div>
  
                <nav class="paging_simple_numbers">
                @include('admin.pagination', ['paginator' => $list]) 
                </nav>
           
              </div>
            </div>
          </div>
        </div>
      </div>
      @include("admin.copyright") 
    </div>    

<script src="{{ URL::asset('admin_assets/js/jquery.min.js') }}"></script>
 
<!-- SweetAlert2 -->
<script src="{{ URL::asset('admin_assets/js/sweetalert2@11.js') }}"></script>


<script type="text/javascript">

'use strict';

$(".enable_disable").on("change",function(e){      
       
      var post_id = $(this).data("id");
      
      var status_set = $(this).prop("checked"); 

      var action_name='property_status';
      

      $.ajax({
        type: 'post',
        url: "{{ URL::to('admin/ajax_status') }}",
        dataType: 'json',
        data: {"_token": "{{ csrf_token() }}",id: post_id, value: status_set, action_for: action_name},
        success: function(res) {

          if(res.status=='1')
          {
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
'use strict';
//Single
$(".data_remove").on('click', function () {      
  
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
            url: "{{ URL::to('admin/ajax_delete') }}",
            dataType: 'json',
            data: {"_token": "{{ csrf_token() }}",id: post_id, action_for: action_name},
            success: function(res) {

              if(res.status=='1')
              {  

                  var selector = "#card_box_id_"+post_id;
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

//Multiple
$("#data_remove_selected").on('click', function () {      
  'use strict';    
  var post_ids = $.map($('.post_ids:checked'), function(c) {
      return c.value;
    });    
     
    if(post_ids.length==0)
    {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: false,         
        })

        Toast.fire({
          icon: 'error',
          title: '{{trans('words.you_didnt_select')}}'
        })
    }
    else
    { 

          var action_name='property_delete_selected';

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
                    url: "{{ URL::to('admin/ajax_delete') }}",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}",id: post_ids, action_for: action_name},
                    success: function(res) {

                      if(res.status=='1')
                      {  
                          $.map($('.post_ids:checked'), function(c) {
                            
                            var post_id= c.value;
                            
                            var selector = "#card_box_id_"+post_id;
                              $(selector ).fadeOut(1000);
                              setTimeout(function(){
                                      $(selector ).remove()
                                  }, 1000);

                            return c.value;
                          });

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

    }
  

});

</script>
<script src="{{ URL::asset('admin_assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
  
  'use strict';

  $(".filter_checkbox").on("change", function(e) {

    var tempArray = [];

    $('input[name="filter_type[]"]:checked').each(function(){
      tempArray.push($(this).val());
    })
   
    var url="{{URL::to('admin/news')}}?filter_type="+tempArray.toString();

    
    if (url) { // require a URL
            window.location = url; // redirect
      }
      return false;
     
  });

  var totalItems = 0;
   $(document).on("click", "#sellect_all", function() {
      
    totalItems = 0;

    $("input[name='post_ids[]']").not(this).prop('checked', this.checked);
    $.each($("input[name='post_ids[]']:checked"), function() {
      totalItems = totalItems + 1;       
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        
      })

    
    if ($("input[name='post_ids[]']").prop("checked") == true) {
        
      Toast.fire({
      icon: 'success',
      title: totalItems + ' {{trans('words.item_checked')}}'
    })

    } else if ($("input[name='post_ids[]']").prop("checked") == false) {
      totalItems = 0;
      
      Toast.fire({
      icon: 'success',
      title: totalItems + ' {{trans('words.item_checked')}}'
    })
      
    }
 
});

$(document).on("click", ".post_ids", function(e) {

'use strict';      
 
if ($(this).prop("checked") == true) {
  totalItems = totalItems + 1;
} else if ($(this).prop("checked") == false) {
  totalItems = totalItems - 1;
}

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
         
      })

    if (totalItems == 0) {
      Toast.fire({
        icon: 'success',
        title: totalItems + ' {{trans('words.item_checked')}}'
      })

      return true;
    }
 
    Toast.fire({
      icon: 'success',
      title: totalItems + ' {{trans('words.item_checked')}}'
    })

 
});

</script> 
 
@endsection

