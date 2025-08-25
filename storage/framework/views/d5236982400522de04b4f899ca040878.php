<!DOCTYPE html>
<html lang="<?php echo e(getcong('default_language')); ?>">
<head>
<meta name="theme-color" content="#7f56d9">  
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="">
<title><?php echo $__env->yieldContent('head_title', getcong('site_name')); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('head_description', getcong('site_description')); ?>" />
<meta name="keywords" content="<?php echo $__env->yieldContent('head_keywords', getcong('site_keywords')); ?>" />
<link rel="canonical" href="<?php echo $__env->yieldContent('head_url', url('/')); ?>">

<meta property="og:type" content="movie" />
<meta property="og:title" content="<?php echo $__env->yieldContent('head_title',  getcong('site_name')); ?>" />
<meta property="og:description" content="<?php echo $__env->yieldContent('head_description', getcong('site_description')); ?>" />
<meta property="og:image" content="<?php echo $__env->yieldContent('head_image', URL::asset('/'.getcong('site_logo'))); ?>" />
<meta property="og:url" content="<?php echo $__env->yieldContent('head_url', url('/')); ?>" />
<meta property="og:image:width" content="1024" />
<meta property="og:image:height" content="1024" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="<?php echo $__env->yieldContent('head_image', URL::asset('/'.getcong('site_logo'))); ?>">
<link rel="image_src" href="<?php echo $__env->yieldContent('head_image', URL::asset('/'.getcong('site_logo'))); ?>">

<!-- Favicon -->
<link rel="icon" href="<?php echo e(URL::asset('/'.getcong('site_favicon'))); ?>">

<!-- Load CSS Files -->
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('site_assets/css/plugin.css')); ?>">
 
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('site_assets/css/'.getcong('styling').'.css')); ?>" id="theme">

<!-- SweetAlert2 -->
<script src="<?php echo e(URL::asset('site_assets/js/sweetalert2@11.js')); ?>"></script>
 

<link rel="stylesheet" href="<?php echo e(URL::asset('site_assets/css/jquery-eu-cookie-law-popup.css')); ?>">

<?php echo $__env->yieldPushContent('styles'); ?>

<?php if(getcong('site_header_code')): ?>
    <?php echo stripslashes(getcong('site_header_code')); ?>

<?php endif; ?>

</head>


<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "RealEstateAgent",
        "name": "<?php echo e(stripslashes(getcong('site_name'))); ?>",
        "url": "<?php echo e(url('/')); ?>",
        "logo": "<?php echo e(URL::asset('/'.getcong('site_logo'))); ?>",
        "sameAs": [
            "<?php echo e(getcong('facebook_link')); ?>",
            "<?php echo e(getcong('twitter_link')); ?>",
            "<?php echo e(getcong('instagram_link')); ?>",
            "<?php echo e(getcong('youtube_link')); ?>"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "<?php echo e(getcong('contact_phone')); ?>",
            "contactType": "Customer Service",             
            "availableLanguage": ["English"]
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?php echo e(getcong('contact_address')); ?>",
            "addressLocality": "",
            "addressRegion": "",
            "postalCode": "",
            "addressCountry": ""
        } 
    }
</script>

<body> 
 

    <?php echo $__env->make("_particles.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

    <?php echo $__env->yieldContent("content"); ?>   
  
    <?php echo $__env->make("_particles.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="eupopup eupopup-bottom"></div>
    
<!-- Load JS Files -->  
<script src="<?php echo e(URL::asset('site_assets/js/plugin.js')); ?>"></script> 

<script src="<?php echo e(URL::asset('site_assets/js/custom-script.js')); ?>"></script>
<script src="<?php echo e(URL::asset('site_assets/js/dashboard.js')); ?>"></script> 


<script src="<?php echo e(URL::asset('site_assets/js/jquery-eu-cookie-law-popup.js')); ?>"></script> 

<script type="text/javascript">
  
<?php if(getcong('gdpr_cookie_on_off')): ?>
  $(document).ready( function() {
  'use strict';  
  if ($(".eupopup").length > 0) {
    $(document).euCookieLawPopup().init({
       'cookiePolicyUrl' : '<?php echo e(stripslashes(getcong('gdpr_cookie_url'))); ?>',
       'buttonContinueTitle' : '<?php echo e(trans('words.gdpr_continue')); ?>',
       'buttonLearnmoreTitle' : '<?php echo e(trans('words.gdpr_learn_more')); ?>',
       'popupPosition' : 'bottom',
       'colorStyle' : 'default',
       'compactStyle' : false,
       'popupTitle' : '<?php echo e(stripslashes(getcong('gdpr_cookie_title'))); ?>',
       'popupText' : '<?php echo e(stripslashes(getcong('gdpr_cookie_text'))); ?>'
    });
  }
});
<?php endif; ?>
</script>
 
<script type="text/javascript">
   
  $(".favourite_property").on('click', function () {      
    
      'use strict';   
     
      var post_id = $(this).data("id");          

      var action_name='property_favourite';     

      $.ajax({
        type: 'post',
        url: "<?php echo e(URL::to('ajax_actions')); ?>",
        dataType: 'json',
        data: {"_token": "<?php echo e(csrf_token()); ?>",id: post_id, action_for: action_name},
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
  title: '<?php echo e(trans('words.dlt_warning')); ?>',
  text: "<?php echo e(trans('words.dlt_warning_text')); ?>",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: '<?php echo e(trans('words.dlt_confirm')); ?>',
  cancelButtonText: "<?php echo e(trans('words.btn_cancel')); ?>",
  background:"#1a2234",
  color:"#fff"

}).then((result) => {
  
    if(result.isConfirmed) { 

        $.ajax({
            type: 'post',
            url: "<?php echo e(URL::to('ajax_actions')); ?>",
            dataType: 'json',
            data: {"_token": "<?php echo e(csrf_token()); ?>",id: post_id, action_for: action_name},
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
                    title: '<?php echo e(trans('words.deleted')); ?>!',
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
	max: <?php echo e(get_max_price()); ?>,
	values: [<?php echo e(get_min_price()); ?>, <?php echo e(get_max_price()); ?>],
	slide: function(event, ui) {
		$("#amount_two").val("<?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?>"+ui.values[0] + " - <?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?>" + ui.values[1]);
	}
});

$("#amount_two").val("<?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?>" + $("#price_range").slider("values", 0) +
			" - <?php echo e(html_entity_decode(getCurrencySymbols(getcong('currency_code')))); ?>" + $("#price_range").slider("values", 1));

       
</script>
 
   
<?php if(getcong('site_footer_code')): ?>
    <?php echo stripslashes(getcong('site_footer_code')); ?>

<?php endif; ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\USER\Documents\Dextra Properties\realestate.dextragroups.com\realestate.dextragroups.com\resources\views/site_app.blade.php ENDPATH**/ ?>