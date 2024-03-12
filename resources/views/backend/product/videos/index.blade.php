@extends('backend.layouts.app')

@section('content')

@php
    CoreComponentRepository::instantiateShopRepository();
    CoreComponentRepository::initializeCache();
@endphp

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Videos')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('videos.create') }}" class="btn btn-primary">
                <span>{{translate('Add New video')}}</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Videos</h5>
        <form class="" id="sort_videos" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>Name</th>
                    <th>Points</th>
                    <th>View</th>
                    <th width="10%" class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $key => $video)
                @php
                $view_count=count(\App\Models\VideoWatch::where('video_id',$video->id)->get());
                @endphp
                    <tr>
                        <td>{{ ($key+1) + ($videos->currentPage() - 1)*$videos->perPage() }}</td>
                        <td>{{ $video->name }}</td>
                        <td>{{ $video->point }}</td>
                        <td>{{ $view_count }}</td>
                       
                       
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('videos.edit', ['id'=>$video->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('videos.destroy', $video->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $videos->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('script')
    <script type="text/javascript">
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('videos.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Featured videos updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
