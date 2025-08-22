<!DOCTYPE html>
<html lang="{{getcong('default_language')}}">
<head>
<meta name="theme-color" content="#7f56d9">  
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="">
<title>@yield('head_title', getcong('site_name'))</title>
<meta name="description" content="@yield('head_description', getcong('site_description'))" />
<meta name="keywords" content="@yield('head_keywords', getcong('site_keywords'))" />
<link rel="canonical" href="@yield('head_url', url('/'))">

<meta property="og:type" content="movie" />
<meta property="og:title" content="@yield('head_title',  getcong('site_name'))" />
<meta property="og:description" content="@yield('head_description', getcong('site_description'))" />
<meta property="og:image" content="@yield('head_image', URL::asset('/'.getcong('site_logo')))" />
<meta property="og:url" content="@yield('head_url', url('/'))" />
<meta property="og:image:width" content="1024" />
<meta property="og:image:height" content="1024" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="@yield('head_image', URL::asset('/'.getcong('site_logo')))">
<link rel="image_src" href="@yield('head_image', URL::asset('/'.getcong('site_logo')))">

<!-- Favicon -->
<link rel="icon" href="{{ URL::asset('/'.getcong('site_favicon')) }}">

<!-- Load CSS Files -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('site_assets/css/plugin.css') }}">
 
<link rel="stylesheet" type="text/css" href="{{ URL::asset('site_assets/css/'.getcong('styling').'.css') }}" id="theme">

<!-- SweetAlert2 -->
<script src="{{ URL::asset('site_assets/js/sweetalert2@11.js') }}"></script>
 

<link rel="stylesheet" href="{{ URL::asset('site_assets/css/jquery-eu-cookie-law-popup.css') }}">

@if(getcong('site_header_code'))
    {!!stripslashes(getcong('site_header_code'))!!}
@endif

</head>


<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "RealEstateAgent",
        "name": "{{stripslashes(getcong('site_name'))}}",
        "url": "{{url('/')}}",
        "logo": "{{URL::asset('/'.getcong('site_logo'))}}",
        "sameAs": [
            "{{getcong('facebook_link')}}",
            "{{getcong('twitter_link')}}",
            "{{getcong('instagram_link')}}",
            "{{getcong('youtube_link')}}"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{getcong('contact_phone')}}",
            "contactType": "Customer Service",             
            "availableLanguage": ["English"]
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{getcong('contact_address')}}",
            "addressLocality": "",
            "addressRegion": "",
            "postalCode": "",
            "addressCountry": ""
        } 
    }
</script>

<body> 
 

    @include("_particles.header") 

    @yield("content")   
  
    @include("_particles.footer")

    <div class="eupopup eupopup-bottom"></div>
    
<!-- Load JS Files -->  
<script src="{{ URL::asset('site_assets/js/plugin.js')}}"></script> 

<script src="{{ URL::asset('site_assets/js/custom-script.js')}}"></script>
<script src="{{ URL::asset('site_assets/js/dashboard.js')}}"></script> 


<script src="{{ URL::asset('site_assets/js/jquery-eu-cookie-law-popup.js') }}"></script> 

<script type="text/javascript">
  
@if(getcong('gdpr_cookie_on_off'))
  $(document).ready( function() {
  'use strict';  
  if ($(".eupopup").length > 0) {
    $(document).euCookieLawPopup().init({
       'cookiePolicyUrl' : '{{stripslashes(getcong('gdpr_cookie_url'))}}',
       'buttonContinueTitle' : '{{trans('words.gdpr_continue')}}',
       'buttonLearnmoreTitle' : '{{trans('words.gdpr_learn_more')}}',
       'popupPosition' : 'bottom',
       'colorStyle' : 'default',
       'compactStyle' : false,
       'popupTitle' : '{{stripslashes(getcong('gdpr_cookie_title'))}}',
       'popupText' : '{{stripslashes(getcong('gdpr_cookie_text'))}}'
    });
  }
});
@endif
</script>
 
<script type="text/javascript">
   
  $(".favourite_property").on('click', function () {      
    
      'use strict';   
     
      var post_id = $(this).data("id");          

      var action_name='property_favourite';     

      $.ajax({
        type: 'post',
        url: "{{ URL::to('ajax_actions') }}",
        dataType: 'json',
        data: {"_token": "{{ csrf_token() }}",id: post_id, action_for: action_name},
        success: function(res) {

          if(res.status=='1')
          {
                  var fav_post_title= '.favourite_title_id'+post_id;
                  var fav_post_icon= '.favourite_icon_id'+post_id;
                  
                  $(fav_post_title).attr('data-original-title', res.set_title);
                  
                  if(res.fav_del=="Yes")
                  { 
                    $(fav_post_icon).toggleClass('fa-heart-o fa-heart');
                  }
                  else
                  {              
                    $(fav_post_icon).toggleClass('fa-heart fa-heart-o');
                  }
                
                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: false,				  
                  })

                  Toast.fire({
                    icon: 'success',
                    title: res.msg_text
                  })    
 
          } 
          else
          { 
            Swal.fire({
              toast: true,
              position: "top-end",
              icon: "error",
              title: res.msg_text,
              showConfirmButton: false,
              timer: 3000
                })
         }
          
        }
      });
}); 

 
//Single
$(".fav_data_remove").on('click',function () {  
  
  'use strict';
  
  var post_id = $(this).data("id");
  
  var action_name='fav_delete';

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

                  var selector = "#post_id_"+post_id;
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

<script>
'use strict';

$("#price_range").slider({
	range: true,
	min: 0,
	max: {{get_max_price()}},
	values: [{{get_min_price()}}, {{get_max_price()}}],
	slide: function(event, ui) {
		$("#amount_two").val("{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}"+ui.values[0] + " - {{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}" + ui.values[1]);
	}
});

$("#amount_two").val("{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}" + $("#price_range").slider("values", 0) +
			" - {{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}" + $("#price_range").slider("values", 1));

       
</script>
 
   
@if(getcong('site_footer_code'))
    {!!stripslashes(getcong('site_footer_code'))!!}
@endif
</body>
</html>