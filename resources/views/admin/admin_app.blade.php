<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{getcong('app_name')}} Admin">
  <meta name="author" content="Dextra Technologies">
  @if(getcong('app_logo'))
  <link rel="shortcut icon" href="{{ URL::asset('/'.getcong('app_logo')) }}">
  @else
  <link rel="shortcut icon" href="{{ URL::asset('site_assets/images/favicon.png') }}">
  @endif
  <title>{{getcong('app_name')}} Admin</title>
 
      <!-- App css -->
     <link href="{{ URL::asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ URL::asset('admin_assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ URL::asset('admin_assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ URL::asset('admin_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ URL::asset('admin_assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
     <link href="{{ URL::asset('admin_assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet">
     <link href="{{ URL::asset('admin_assets/css/style.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ URL::asset('admin_assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />  
      
     <link href="{{ URL::asset('admin_assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" /> 
 
  <!-- SweetAlert2 -->
  <script src="{{ URL::asset('admin_assets/js/sweetalert2@11.js') }}"></script>

 
</head>
  <body class="fixed-left">
    <div id="wrapper">
   
    @include("admin.topbar") 

    @include("admin.sidebar")

    @yield("content")

    </div>

  <!-- jQuery  -->

   
  <script src="{{ URL::asset('admin_assets/js/jquery.min.js') }}"></script>
  <script src="{{ URL::asset('admin_assets/js/bootstrap.min.js') }}"></script>  
  <script src="{{ URL::asset('admin_assets/js/detect.js') }}"></script>     
   <script src="{{ URL::asset('admin_assets/js/jquery.nicescroll.js') }}"></script>   
  <script src="{{ URL::asset('admin_assets/js/jquery.slimscroll.js') }}"></script>


  <script src="{{ URL::asset('admin_assets/plugins/tippy.js/tippy.all.min.js') }}"></script>
  <script src="{{ URL::asset('admin_assets/plugins/switchery/switchery.min.js') }}"></script>
  <script src="{{ URL::asset('admin_assets/plugins/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ URL::asset('admin_assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script> 
  <script src="{{ URL::asset('admin_assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script> 
  <script type="text/javascript" src="{{ URL::asset('admin_assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
  <script src="{{ URL::asset('admin_assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
  
  @if(classActivePath('dashboard'))
  <!-- Counter Up  -->
  <script src="{{ URL::asset('admin_assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ URL::asset('admin_assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
  @endif

  <!-- App js -->
   <script src="{{ URL::asset('admin_assets/js/jquery.core.js') }}"></script>
   <script src="{{ URL::asset('admin_assets/js/jquery.app.js') }}"></script>
   <script src="{{ URL::asset('admin_assets/js/custom.js') }}"></script>   

  <link rel="stylesheet" href="{{url('packages')}}/barryvdh/elfinder/css/colorbox.css"> 
  <script src="{{url('packages')}}/barryvdh/elfinder/js/jquery.colorbox.js"></script>
  <script type="text/javascript" src="{{url('packages')}}/barryvdh/elfinder/js/jquery.colorbox-min.js"></script>


<script type="text/javascript">
     
$(document).on('click','.popup_selector',function (event) {
    'use strict';
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = "{{ URL::to('elfinder/popup') }}/";

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '80%'
    });

}); 

 </script>       
  
    </body>
</html>