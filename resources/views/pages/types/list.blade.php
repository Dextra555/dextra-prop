@extends('site_app')

@section('head_title', trans('words.type_text').' - '. getcong('site_name') )

@section('head_url', Request::url())

@section('content')

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "ItemList",
  "itemListElement": [    
          @php $i = 1; @endphp 
          @foreach($type_list as $type_data)
          @php
              $separator = ',';
              if($i == count($type_list)){
                $separator = '';
                }
            $i++;
          @endphp              
            {
                "@type": "ListItem",
                "name": "{{$type_data->type_name}}",
                "position": {{$type_data->id}},
                "url": "{{ URL::to('types/'.$type_data->type_slug.'/'.$type_data->id) }}"
                
            }{{$separator}}
            @endforeach
  ]
}
</script>
 
   
<!--Breadcrumb section starts-->
<div class="breadcrumb-section bg-xs" style="background-image: url({{ URL::asset('site_assets/images/breadcrumb-1.jpg') }})">
    <div class="overlay op-2"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <div class="breadcrumb-menu">
            <h2>{{trans('words.type_text')}} </h2>
            <span><a href="{{ URL::to('/') }}" title="{{trans('words.home')}}">{{trans('words.home')}}</a></span> <span>{{trans('words.type_text')}}</span> 
		      </div>
        </div>
      </div>
    </div>
  </div>
  <!--Breadcrumb section ends--> 

  <!-- Add banner Section -->
  @if(get_web_banner('list_top')!="")      
      <div class="add_banner_section pb-0">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
              {!!stripslashes(get_web_banner('list_top'))!!}
            </div>
          </div>  
        </div>
      </div>
  @endif   
  <!-- Add banner Section -->

  <!--Listing Filter starts-->
  <div class="filter-wrapper style1 pt-30 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="vfx-agent-details-wrapper">
            <div class="item-wrapper">
              <div class="tab-content">
                <div id="grid-view" class="active">
                  <div class="row">
                    @foreach($type_list as $type_data)
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                       <div class="vfx-single-team-member vfx-cat-item vfx2"> 
                          <a href="{{ URL::to('types/'.$type_data->type_slug.'/'.$type_data->id) }}" title="{{$type_data->type_name}}"><img src="{{URL::to('/'.$type_data->type_image)}}" alt="{{$type_data->type_name}}" title="{{$type_data->type_name}}"></a>
                          <div class="vfx-single-team-info">
                          <h4><a href="{{ URL::to('types/'.$type_data->type_slug.'/'.$type_data->id) }}">{{$type_data->type_name}}</a></h4>
                          </div>
					              </div>
                    </div>
                    @endforeach
  

                  </div>

                  <!--pagination starts-->
                  <div class="post-nav nav-res pt-10">
                      <div class="row">

                        @include('_particles.pagination', ['paginator' => $type_list]) 

                      </div>
                    </div>
                    <!--pagination ends--> 

                </div>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
  <!--Listing Filter ends--> 
  
  @if(get_web_banner('list_bottom')!="")      
    <div class="add_banner_section mb-10">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
            {!!stripslashes(get_web_banner('list_bottom'))!!}
          </div>
        </div>  
      </div>
    </div>
@endif
 
@endsection