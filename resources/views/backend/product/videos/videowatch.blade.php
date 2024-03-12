
        <table class="table aiz-table mb-0" style="opacity:1">
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
                @foreach($videos as $key => $videoz)
             
                
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
                        <td>{{ $user->postal_code }}</td>
                        <td>{{ date("d M Y", strtotime($videoz->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
               video_id: {{$video_id}},
            },
            success: function(data) {
                $("#table-search").html(data.html);
           }
       });


    })

</script>
@endsection