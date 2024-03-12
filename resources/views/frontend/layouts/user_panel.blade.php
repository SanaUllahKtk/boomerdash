@extends('frontend.layouts.app')
@section('content')
<style>
    @media(max-width:490px){
        .mobile-spaces{
            padding-top:0rem!important;
        }
    }
</style>
<section class="py-5 mobile-spaces">
    <div class="container">
        <div class="d-flex align-items-start">
			@include('frontend.inc.user_side_nav')
			<div class="aiz-user-panel">
				@yield('panel_content')
            </div>
        </div>
    </div>
</section>
@endsection