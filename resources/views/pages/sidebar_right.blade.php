@if(Auth::check() and getcong('recaptcha_on_contact_us'))
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script>
		function submitForm() {
			var response = grecaptcha.getResponse();
			if (response.length == 0) {
				document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
				return false;
			}

			return true;
		}

		function verifyCaptcha() {
			document.getElementById('g-recaptcha-error').innerHTML = '';
		}
	</script>
@endif

<div class="col-xl-4 order-xl-12 order-xl-1 order-1">
	<div id="list-sidebar" class="sidebar-right mt-30">

		@if(isset($user_id))
			<div class="widget">



				<div class="agent-title">

					<div class="agent-photo">
						@if(file_exists(URL::to('upload/' . get_user_info($user_id, 'user_image'))))
							<img src="{{\URL::to('upload/' . get_user_info($user_id, 'user_image'))}}" alt="user"
								title="user image">
						@else
							<img src="{{\URL::to('site_assets/images/user-default.jpg')}}" alt="user" title="user image">
						@endif 
					</div>

					<div class="agent-details">
						<a href="{{ URL::to('properties/owner/' . $user_id) }}" class="property-author" title="User">

							<h4>{{get_user_info($user_id, 'name')}}</h4>

						</a>

					</div>
					<div class="clearfix"></div>
				</div>

			</div>
		@endif

		@if(Auth::check())

			<div class="widget">
				<div class="agent-title">
					<div class="chat-button mt-0">
						<h3 class="widget-title">{{trans('words.contact_us')}}</h3>
					</div>

					{{ html()->form('POST', url('/properties/contact'))
			->attributes(['class' => 'contact_form_block', 'id' => 'contact_form', 'name' => 'contact_form', 'role' => 'form', 'onsubmit' => 'return submitForm();'])->open() }}

					<input type="hidden" name="property_title"
						value="{{ isset($property_info->title) ? stripslashes($property_info->title) : 'Contact Us' }}">
					<input type="hidden" name="property_owner_id" value="{{ isset($user_id) ? $user_id : $owner_id }}">

					<div class="form-control-wrap">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="name" placeholder="{{trans('words.name')}}*"
										name="name" required>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<input type="email" class="form-control" id="email_address"
										placeholder="{{trans('words.email')}}*" name="email" required>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="phone"
										placeholder="{{trans('words.phone')}}" name="phone">
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<textarea class="form-control" rows="3" name="message" id="message"
										placeholder="{{trans('words.message')}}"></textarea>
								</div>
							</div>
							@if(getcong('recaptcha_on_contact_us'))
								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<div class="g-recaptcha" data-sitekey="{{getcong('recaptcha_site_key')}}"
											data-callback="verifyCaptcha"></div>
										<div id="g-recaptcha-error"></div>
									</div>
								</div>
							@endif
							<div class="col-lg-12 col-md-12">
								<div class="form-group mb-0">
									<button type="submit" class="btn vfx7">{{trans('words.send_message')}}</button>
								</div>
							</div>
						</div>
					</div>
					{{ html()->form()->close() }}
				</div>
			</div>
						

		@else
			<div class="widget">
				<div class="agent-title">
					<div class="chat-button mt-0">
						<h3 class="widget-title">{{trans('words.login_to_contact')}}</h3>
						<a href="{{ URL::to('/login') }}" class="btn vfx7 w-100"
							title=="login">{{trans('words.login_text')}}</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

		@endif


		<div class="widget">
			<h3 class="widget-title">{{trans('words.latest_property')}}</h3>

			@foreach($latest_list as $latest) 
				<div class="row recent-list">
					<div class="col-lg-5 col-4">
						<div class="entry-img"> 
							<a href="{{ URL::to('properties/' . $latest->slug . '/' . $latest->id) }}" title="stripslashes($latest->title)">
								<img src="{{\URL::to('/' . $latest->image)}}" alt="latest"
								title="{{stripslashes($latest->title)}}">
							</a>

							@if($latest->purpose == 'Rent')
								<span>{{trans('words.rent')}}</span>
							@else
								<span>{{trans('words.sale')}}</span>
							@endif

						</div>
					</div>
					<div class="col-lg-7 col-8 no-pad-left">
						<div class="entry-text">
							<p class="text-tlt">{{ $latest->types->type_name }}</p>
							<h4 class="entry-title"><a href="{{ URL::to('properties/' . $latest->slug . '/' . $latest->id) }}"
									title="{{stripslashes($latest->title)}}">{{Str::limit(stripslashes($latest->title), 20)}}</a>
							</h4>
							<div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
								<p>
								@if(isset($latest->locations->name) AND $latest->locations->name!="")
                              	{{$latest->locations->name}}
								@else
								{{Str::limit(stripslashes($latest->address),20)}}
								@endif
								</p>
							</div>
							<div class="vfx-trend-open-price">
								{{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($latest->price)}}
							</div>
						</div>
					</div>
				</div>
			@endforeach



		</div>

		@if(get_web_banner('sidebar') != "")
			<div class="sidebar">
				<div class="add_banner_section">
					<div class="col-md-12">

						{!!stripslashes(get_web_banner('sidebar'))!!}

					</div>
				</div>
			</div>
		@endif	


	</div>
</div>