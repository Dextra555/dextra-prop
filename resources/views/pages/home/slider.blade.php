  <!--Hero section starts-->
  <div class="hero vfx2 section-padding" style="background-image: url({{ URL::asset('site_assets/images/slider1.jpg') }})">
    <div class="overlay"></div>
    <!--Listing filter starts-->
    <div class="container vfx-posabs">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="header-text vfx1">
             <p class="text-uppercase mb-10">{{trans('words.slider_text1')}}</p>
             <h1>{{trans('words.slider_text2')}}</h1>
             <p>{{trans('words.slider_text3')}}</p>
          </div>
        </div>
        <div class="col-md-12">
         
        {{ html()->form('GET', url('/properties/search'))
                     ->attributes(['class' => 'vfx_hero_form_area vfx2 filter listing-filter bg-cb', 'id' => 'search', 'role' => 'form'])->open() }}
           
            <div class="row">
              <div class="col-xl-4 col-lg-3 col-sm-12 pr-lg-0">
                <div class="input-search">
                  <input type="text" name="search_text" id="search_text" placeholder="{{trans('words.search_by_title')}}">
                </div>
              </div>
              <div class="col-xl-2 col-lg-3 col-sm-12 pr-lg-0">
                <select name="purpose" class="vfx_hero_form_area_input vfx-custom-select-area">
                    <option value="">{{trans('words.purpose')}}</option>
                     
                     <option value="{{trans('words.sale')}}">{{trans('words.sale')}}</option>
                     <option value="{{trans('words.rent')}}">{{trans('words.rent')}}</option>                  
                </select>
              </div>
              <div class="col-xl-2 col-lg-3 col-sm-12 pr-lg-0">
                <select name="type_id" class="vfx_hero_form_area_input vfx-custom-select-area">
                  <option value="">{{trans('words.property_type')}}</option>
                  @foreach(\App\Type::where('status',1)->orderby('type_name')->get() as $type_data)
                    <option value="{{$type_data->id}}">{{$type_data->type_name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-xl-2 col-lg-3 col-sm-12 pr-lg-0">
                <select name="location_id" class="vfx_hero_form_area_input vfx-custom-select-area">
                  <option value="">{{trans('words.location')}}</option>
                  @foreach(\App\Location::where('status',1)->orderby('name')->get() as $location_data)
                    <option value="{{$location_data->id}}">{{$location_data->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-xl-2 col-lg-3 col-sm-12">
                <div class="submit_btn">
                  <button class="btn vfx3" type="submit">{{trans('words.search_property')}}</button>
                </div>
              </div>              
            </div>
            {{ html()->form()->close() }}
        </div>
      </div>
    </div>
    <!--Listing filter ends--> 
  </div>
  <!--Hero section ends--> 