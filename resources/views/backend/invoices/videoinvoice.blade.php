<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{  translate('INVOICE') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
	<style media="all">
        @page {
			margin: 0;
			padding:0;
		}
		body{
			font-size: 0.875rem;
            font-family: '<?php echo  $font_family ?>';
            font-weight: normal;
            direction: <?php echo  $direction ?>;
            text-align: <?php echo  $text_align ?>;
			padding:0;
			margin:0; 
		}
		.gry-color *,
		.gry-color{
			color:#000;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .25rem .7rem;
		}
		table.padding td{
			padding: .25rem .7rem;
		}
		table.sm-padding td{
			padding: .1rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align:<?php echo  $text_align ?>;
		}
		.text-right{
			text-align:<?php echo  $not_text_align ?>;
		}
	</style>
</head>
<body>
	<div>

		@php
			$logo = get_setting('header_logo');
		@endphp


	    <div style="padding: 1rem;">
			<table class="padding text-left small border-bottom">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="35%" class="text-left">{{ translate('Video Name') }}</th>
						<th width="15%" class="text-left">{{ translate('User Name') }}</th>
	                    <th width="10%" class="text-left">{{ translate('Country') }}</th>
	                    <th width="15%" class="text-left">{{ translate('State') }}</th>
	                    <th width="10%" class="text-left">{{ translate('City') }}</th>
	                    <th width="15%" class="text-right">{{ translate('Postal Code') }}</th>
	                    <th width="15%" class="text-right">{{ translate('Date') }}</th>
	                </tr>
				</thead>
				<tbody class="strong">
	                @foreach ($videos as $key => $videoWatch )
	                @php
	                
        $name = '';
        $videoname = '';
        $country ='';
        $state = '';
        $city = '';
        $postal_code = '';
            $user=\App\Models\User::where('id',$videoWatch->user_id)->first();
            $video=\App\Models\Video::where('id',$videoWatch->video_id)->first();
            $name .= $user->name;
            $postal_code .= $user->postal_code;
            
            $state.=\App\Models\State::where('id',$user->state)->first();
            $country.=\App\Models\Country::where('id',$user->country)->first();
            $city.=\App\Models\City::where('id',$user->city)->first();
            
            $videoname .= $video->name;
	                @endphp
						 <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $name }}</td>
                        <td>@if(!empty($country->name)){{ $country->name }}@endif</td>
                        <td>@if(!empty($state->name)){{ $state->name }}@endif</td>
                        <td>@if(!empty($city->name)){{ $city->name }}@endif</td>
                        <td>{{ $user->postal_code }}</td>
                        <td>{{ date("d M Y", strtotime($videoWatch->created_at)) }}</td>
                    </tr>
					@endforeach
	            </tbody>
			</table>
		</div>


	</div>
</body>
</html>
