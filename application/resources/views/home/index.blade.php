@extends('layouts.app')

@section('content')
    <div class="row clearfix">
        @include('partials.sidebar')
	    <div class="col-lg-9 col-md-12">
		    <div class="row">
				<div class="col" >
		        	@include('partials.flash')

		        	@include('home.partials.requests')

			        @include('home.partials.transactions_to_confirm')
			        
			        @include('home.partials.transactions')

		    	</div>
		    </div>
		</div>

    </div>
@endsection

@section('footer')
	@include('partials.footer')
@endsection
