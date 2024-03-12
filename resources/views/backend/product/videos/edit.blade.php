@extends('backend.layouts.app')

@section('content')

@php
    CoreComponentRepository::instantiateShopRepository();
    CoreComponentRepository::initializeCache();
@endphp

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('video Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Models\Language::all() as $key => $language)
                    <li class="nav-item">
                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('categories.edit', ['id'=>$video->id, 'lang'=> $language->code] ) }}">
                            <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                            <span>{{$language->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <form class="p-4" action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
    	            <input type="hidden" name="lang" value="{{ $lang }}">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{ $video->name}}" class="form-control" id="name" placeholder="{{translate('Name')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Video')}}</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="file" name="videolink" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
    	            <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Banner')}} <small>({{ translate('200x200') }})</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="banner" class="selected-files" value="{{ $video->banner }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Video Points')}}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="point" value="{{ $video->point }}" placeholder="{{translate('Video Points')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Description')}}</label>
                        <div class="col-md-9">
                            <textarea name="meta_description" rows="5" class="form-control">{{ $video->meta_description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Viewer Details</h5>

    </div>
    <div class="card-body">
        <form action="{{ route('videos.excel', $video->id) }}" method="get">
                    <div class="row">
                    <div class="form-group col-md-4">
                        <div class="col-md-12">
                        <label>{{translate('Start Date:')}} </label>
                            <input type="date" name="start_date" value="" class="form-control" id="start_date" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="col-md-12">
                        <label>{{translate('End Date:')}} </label>
                            <input type="date" name="end_date" value="" class="form-control" id="end_date" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4"style="margin: 25px 0px;">
                    <a href="javascript:void(0)" class="btn btn-primary search">{{translate('Filter')}}</a>
                    <a href="javascript:void(0)" class="btn btn-primary pdf">{{translate('Pdf')}}</a>
                    <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                    </div>
                    </form>
    <div id="table-search">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Code</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\VideoWatch::where('video_id',$video->id)->get() as $key => $videoz)
   
                
                @php
	                
            $user=\App\Models\User::where('id',$videoz->user_id)->first();
            $video=\App\Models\Video::where('id',$videoz->video_id)->first();
            $name= $user->name;
            $postal_code= $user->postal_code;
            
            $state=\App\Models\State::where('id',$user->state)->first();
            $country=\App\Models\Country::where('id',$user->country)->first();
            $city=\App\Models\City::where('id',$user->city)->first();
            
            $videoname= $video->name;
	                @endphp
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $name }}</td>
                        <td>@if(!empty($country->name)){{ $country->name }}@endif</td>
                        <td>@if(!empty($state->name)){{ $state->name }}@endif</td>
                        <td>@if(!empty($city->name)){{ $city->name }}@endif</td>
                        <td>{{ $user->postal_code }}</td>
                        <td>{{ date("d M Y", strtotime($videoz->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    
    $(document).on("click", ".search",function(e) {
        e.preventDefault();
        var start_date=$("#start_date").val();
        var end_date=$("#end_date").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'{{ route('videos.search') }}',
            data:{
               start_date: start_date,
               end_date: end_date,
               video_id: {{$video->id}},
            },
            success: function(data) {
                $("#table-search").html(data.html);
           }
       });


    });
    
    
    $(document).on("click", ".pdf",function(e) {
        e.preventDefault();
        var start_date=$("#start_date").val();
        var end_date=$("#end_date").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'{{ route('videopdf.download') }}',
            data:{
               start_date: start_date,
               end_date: end_date,
               video_id: {{$video->id}},
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "techsolutionstuff.pdf";
                link.click();
           }
       });


    });
    
 
</script>
@endsection
