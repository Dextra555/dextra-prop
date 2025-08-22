<!--Sidebar starts-->
<div class="sidebar-left sidebar">
  <div class="widget filter-widget search">
    <h3 class="widget-title">{{trans('words.advance_search_filter')}}</h3>
    {{ html()->form('GET', url('/properties/search'))
  ->attributes(['class' => 'vfx_hero_form_area vfx2 filter', 'id' => 'search', 'name' => 'search', 'role' => 'form'])->open() }}

    <div class="row">
      <div class="col-lg-12 col-md-12 mb-3">
        <input type="text" name="search_text" value="@if(isset($_GET['search_text'])){{$_GET['search_text']}}@endif"
          class="form-control" placeholder="{{trans('words.search_by_title')}}" autocomplete="off">
      </div>

      <div class="col-lg-12 col-md-12 mb-3">
        <select name="purpose" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value="">{{trans('words.purpose')}}</option>

          <option value="Sale" @if(isset($_GET['purpose']) and $_GET['purpose'] == "Sale") selected @endif>
            {{trans('words.sale')}}</option>
          <option value="Rent" @if(isset($_GET['purpose']) and $_GET['purpose'] == "Rent") selected @endif>
            {{trans('words.rent')}}</option>

        </select>
      </div>

      <div class="col-lg-12 col-md-12 mb-3">
        <select name="type_id" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value="">{{trans('words.type')}}</option>

           @foreach(\App\Type::where('status', 1)->orderby('type_name')->get() as $type_data)
            <option value="{{$type_data->id}}" @if(isset($_GET['type_id']) and $_GET['type_id'] == $type_data->id) selected
            @endif>{{$type_data->type_name}}</option>
            @endforeach

        </select>
      </div>

      <div class="col-lg-12 col-md-12 mb-3">
        <select name="location_id" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value="">{{trans('words.location')}}</option>

          @foreach(\App\Location::where('status', 1)->orderby('name')->get() as $location_data)
            <option value="{{$location_data->id}}" @if(isset($_GET['location_id']) and $_GET['location_id'] == $location_data->id) selected
          @endif>{{$location_data->name}}</option>
          @endforeach

        </select>
      </div>

      <div class="col-lg-12 col-md-12 mb-3">
        <select name="bedrooms" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value="">{{trans('words.bedrooms')}} : Any</option>
          <option value="1" @if(isset($_GET['bedrooms']) and $_GET['bedrooms'] == "1") selected @endif>1</option>
          <option value="2" @if(isset($_GET['bedrooms']) and $_GET['bedrooms'] == "2") selected @endif>2</option>
          <option value="3" @if(isset($_GET['bedrooms']) and $_GET['bedrooms'] == "3") selected @endif>3</option>
          <option value="4" @if(isset($_GET['bedrooms']) and $_GET['bedrooms'] == "4") selected @endif>4+</option>
        </select>
      </div>
      <div class="col-lg-12 col-md-12 mb-3">
        <select name="bathrooms" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value="">{{trans('words.bathrooms')}} : Any</option>
          <option value="1" @if(isset($_GET['bathrooms']) and $_GET['bathrooms'] == "1") selected @endif>1</option>
          <option value="2" @if(isset($_GET['bathrooms']) and $_GET['bathrooms'] == "2") selected @endif>2</option>
          <option value="3" @if(isset($_GET['bathrooms']) and $_GET['bathrooms'] == "3") selected @endif>3</option>
          <option value="4" @if(isset($_GET['bathrooms']) and $_GET['bathrooms'] == "4") selected @endif>4+</option>
        </select>
      </div>
      <div class="col-lg-12 col-md-12 mb-3">
        <select name="furnishing" class="vfx_hero_form_area_input vfx-custom-select-area">

          <option value="">{{trans('words.furnishing')}} : Any</option>
          <option value="Unfurnished" @if(isset($_GET['furnishing']) and $_GET['furnishing'] == "Unfurnished") selected
    @endif>Unfurnished</option>
          <option value="Semi-Furnished" @if(isset($_GET['furnishing']) and $_GET['furnishing'] == "Semi-Furnished")
    selected @endif>Semi-Furnished</option>
          <option value="Furnished" @if(isset($_GET['furnishing']) and $_GET['furnishing'] == "Furnished") selected
    @endif>Furnished</option>
        </select>
      </div>
      <div class="col-lg-12 col-md-12 mb-3">
        <select name="verified" class="vfx_hero_form_area_input vfx-custom-select-area">
          <option value="">{{trans('words.verified_status')}}</option>
          <option value="NO" @if(isset($_GET['verified']) and $_GET['verified'] == "NO") selected @endif>
            {{trans('words.non_verified_properties')}}</option>
          <option value="YES" @if(isset($_GET['verified']) and $_GET['verified'] == "YES") selected @endif>
            {{trans('words.verified_properties')}}</option>
        </select>
      </div>

      <div class="col-md-12">
        <div class="filter-sub-area style1">
          <div class="filter-title mb-20">
            <label for="amount_two">{{trans('words.price_range')}}:</label> <span><input type="text" id="amount_two"
                name="price_range"></span>
          </div>
          <div id="price_range" class="price-range mb-30"> </div>
        </div>
      </div>


      <div class="col-xl-12 col-lg-12 col-sm-12 col-12">
        <button class="btn vfx8" type="submit">{{trans('words.search_property')}}</button>
      </div>

    </div>

    {{ html()->form()->close() }}
  </div>
  <div class="widget recent">
    <h3 class="widget-title">{{trans('words.latest_property')}}</h3>
    @foreach(\App\Property::with(['types', 'locations', 'users'])->where('status', 1)->orderby('id', 'DESC')->limit(5)->get() as $latest_data)
    <div class="row recent-list">
      <div class="col-lg-5 col-4">
      <div class="entry-img">
      <a href="{{ URL::to('properties/' . $latest_data->slug . '/' . $latest_data->id) }}"
      title="stripslashes($latest_data->title)">
        <img src="{{\URL::to('/' . $latest_data->image)}}" alt="{{stripslashes($latest_data->title)}}" title="{{stripslashes($latest_data->title)}}">
      </a>
        @if($latest_data->purpose == 'Rent')
      <span>{{trans('words.rent')}}</span>
    @else
    <span>{{trans('words.sale')}}</span>
  @endif
      </div>
      </div>
      <div class="col-lg-7 col-8 no-pad-left">
      <div class="entry-text">
        <p class="text-tlt">{{ $latest_data->types->type_name }}</p>
        <h4 class="entry-title"><a href="{{ URL::to('properties/' . $latest_data->slug . '/' . $latest_data->id) }}"
          title="stripslashes($latest_data->title)">{{Str::limit(stripslashes($latest_data->title), 20)}}</a></h4>
        <div class="vfx-property-location"> <i class="fa fa-map-marker"></i>
        <p>
        @if(isset($latest_data->locations->name) AND $latest_data->locations->name!="")
        {{$latest_data->locations->name}}
        @else
        {{Str::limit(stripslashes($latest_data->address),20)}}
        @endif
        </p>
        </div>
        <div class="vfx-trend-open-price">
        {{html_entity_decode(getCurrencySymbols(getcong('currency_code')))}}{{number_format($latest_data->price)}}
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
<!--Sidebar ends-->