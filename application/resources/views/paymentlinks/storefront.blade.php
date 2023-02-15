<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{setting('site.title')}}</title>

    <!-- Styles -->
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    --}}
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.3.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/morris.min.css')}}" />
    <!-- Custom Css -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css')}}"> -->
   @include('paymentlinks.styles')

</head>
<body class="theme-blue">
    <div id="app">
      
        <div class="container">
        	<div class="row">
		        <div class="col">
		            @include('partials.flash')
		        </div>
		    </div>
		    <div class="row justify-content-md-center">
		    @include('paymentlinks.paymentForm')
		    </div>
		</div>
    </div>
    <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- dd(session()->has('PurchaseRequest')) --}}
</body>
</html>
