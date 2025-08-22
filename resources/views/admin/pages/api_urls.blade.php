@extends("admin.admin_app")

@section("content")
 <?php $base_url=\URL::to('/').'/api/v1/';?>
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-box" style="color: #a9b7c6;">
                <h3 style="font-weight: 600;">APIs</h3>
                 <code style="color: #a9b7c6;background: #2b3751;padding: 5px 10px;font-size: 14px;font-weight: 600;"> API URL  {{$base_url}}</code><br/><br/>
                  <b>App Details:</b>  (Method: app_details)<br/><br/>
  
                  <br/>
                  <b>Payment Settings:</b> (Method: payment_settings) <br/><br/>

                  <b>Home:</b> (Method: home) (Parameter: user_id)<br/><br/>                 
                   
                  <b>Types List:</b> (Method: types) <br/><br/>

                  <b>Location List:</b> (Method: location) <br/><br/>
                  
                  <b>Property by Types:</b> (Method: property_by_types)(Parameter: type_id,user_id) <br/><br/>

                  <b>Property Details:</b> (Method: property_details)(Parameter: property_id,user_id) <br/><br/>
                  
                  <b>Latest Property:</b> (Method: latest_property)(Parameter: user_id, filter_by(price_high, price_low, distance)) <br/><br/>

                  <b>Trending Property:</b> (Method: trending_property)(Parameter: user_id) <br/><br/>

                  <b>Search Property:</b> (Method: search_property)(Parameter: user_id, (verified(YES,NO), price_start, price_end, bedrooms, bathrooms, furnishing(Semi-Furnished, Furnished, Unfurnished), type_id, location_id)) <br/><br/>

                  <b>Normal Search Property:</b> (Method: normal_search_property)(Parameter: user_id, type_id, location_id, purpose(Sale,Rent), search_text) <br/><br/>
                    
                  <b>Post Views:</b> (Method: post_view) (Parameter: post_id, post_type(Property)) <br/><br/>
                    
                  <b>Post Favourite:</b> (Method: post_favourite) (Parameter: user_id, post_id,post_type(Property))<br/><br/>                   
 
                  <b>Login:</b> (Method: login) (Parameter: email, password)<br/><br/>
                  <b>Signup:</b> (Method: signup) (Parameter: name, email, password, phone)<br/><br/>
                  <b>Social Login:</b> (Method: social_login) (Parameter: login_type(google or facebook), social_id, name, email)<br/><br/>
                  <b>Forgot Password:</b> (Method: forgot_password) (Parameter: email)<br/><br/>
                  <b>Profile:</b> (Method: profile) (Parameter: user_id)<br/><br/>
                  <b>Profile Update:</b> (Method: profile_update) (Parameter: user_id)<br/><br/>
                  
                  <b>User Property:</b> (Method: user_property) (Parameter: user_id)<br/><br/>
                  <b>User Add Property:</b> (Method: user_add_property) (Parameter: user_id, type_id, location_id,title, description, phone, address, latitude, longitude, purpose(Sale,Rent), bedrooms, bathrooms, area, furnishing(Unfurnished,Semi-Furnished,Furnished), amenities, price, verified(NO,YES), image, floor_plan_image, image_gallery(array))<br/><br/>

                  <b>User Edit Property:</b> (Method: user_edit_property) (Parameter: post_id)<br/><br/>

                  <b>User Edit Property Save:</b> (Method: user_edit_property_save) (Parameter: post_id, user_id, type_id, location_id, title, description, phone, address, latitude, longitude, purpose(Sale,Rent), bedrooms, bathrooms, area, furnishing(Unfurnished,Semi-Furnished,Furnished), amenities, price, verified(NO,YES), image, floor_plan_image, image_gallery(array))<br/><br/>

                  <b>User Property Gallery Delete:</b> (Method: user_property_gallery_delete) (Parameter: post_id)<br/><br/>
                  
                  <b>User Favourite Post:</b> (Method: user_favourite_post_list) (Parameter: user_id)<br/><br/>
                   
                  <b>User Report:</b> (Method: user_reports) (Parameter: user_id, post_id, post_type(Property), message)<br/><br/>

                  <b>Check User Plan:</b> (Method: check_user_plan) (Parameter: user_id)<br/><br/>
                  <b>Subscription Plan:</b> (Method: subscription_plan) <br/><br/>
                  <b>Transaction Add:</b> (Method: transaction_add) (Parameter: plan_id, user_id, payment_id, payment_gateway) <br/><br/>                   
                  
                  <b>Stripe Token Get:</b> (Method: stripe_token_get) (Parameter: amount)<br/><br/>
                  <b>Braintree Token Get:</b> (Method: get_braintree_token)<br/><br/>
                  <b>Braintree Checkout:</b> (Method: braintree_checkout) (Parameter: payment_amount, payment_nonce)<br/><br/>
                  <b>Razorpay Order ID Get:</b> (Method: razorpay_order_id_get) (Parameter: amount,user_id)<br/><br/>
                  <b>Payu Hash Get:</b> (Method: get_payu_hash) (Parameter: hashdata)<br/><br/>
                   
              </div>
 
            </div>
          </div>
        </div>
      </div>
      @include("admin.copyright") 
    </div>

@endsection