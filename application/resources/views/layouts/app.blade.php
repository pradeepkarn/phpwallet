<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page') - {{ setting('site.site_name') }}</title>

    <!-- Styles -->
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">  --}}

    <!-- Styles --> 
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    
   {{--  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon--> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.3.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/morris.min.css')}}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css')}}">
    

    <style type="text/css">
    [v-cloak]{
        display:none;
    }
    .jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;box-sizing: content-box;z-index: 10000;}
    .jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
    .bitcoin .body {position: absolute;word-break: break-all;}
    .remove{cursor: pointer;}
    .top_navbar{border-bottom: none }
    .navbar-nav>li>a .label-count{position: unset;}
    .menu_dark .sidebar {box-shadow: none !important;}
    @impersonating
    .top_navbar{background:#fff;}
    section.content::before{background:#fff;}
    .menu_dark .sidebar {background: #fff;box-shadow: none !important;}
    .navbar-nav>li>a .label-count {background-color: #50d38a;color: #fff;}
    .navbar-logo .navbar-brand span {color: #50d38a;}
    @endImpersonating
    @yield('styles')
    </style>


    @include('partials.footerstyles')

    <script src="{{ asset('js/vue.min.js') }}"></script>
    {{--
    @include('layouts.jquery')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script> 
    --}}
</head>
<body class="{{setting('site.color_theme')}} menu_dark" id="app">
@auth
<div class="modal fade" id="walletModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-green">
            <div class="modal-header">
                {{-- <h4 class="title" id="smallModalLabel">Modal title</h4> --}}
            </div>
            <div class="modal-body"> 

                    <div class="row ">
                @if(count(Auth::user()->wallets()))
                    @foreach(Auth::user()->wallets() as $someWallet)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="{{ url('/') }}/{{app()->getLocale()}}/wallet/{{$someWallet->id}}">
                            <div class="card info-box-2" style="cursor: pointer;min-height: auto;margin-bottom: 10px">
                                <div class="body mb-0">
                                    <ul class="follow_us list-unstyled mb-0">
                                        <li class="offline">
                                                <div class="media mb-0">
                                                    <img class="media-object " src="{{ $someWallet->currency->thumb}}" alt="">
                                                    <div class="media-body">
                                                        <span class="name">{{ $someWallet->currency->name }}</span>
                                                        <span class="message">{{ \App\Helpers\Money::instance()->value($someWallet->amount, $someWallet->currency->symbol, $someWallet->currency->is_crypto) }}</span>
                                                        <span class="badge badge-outline status"></span>
                                                    </div>
                                                </div>                         
                                        </li>                        
                                    </ul>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-primary btn-round waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content  bg-green">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">{{__('Select the wallet currency')}}</h4>
            </div>
            <div class="modal-body"> 
                <div class="row clearfix">
                @foreach(\App\Models\Currency::orderby('is_crypto')->paginate(10) as $currency)
                <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="{{url('/')}}/{{app()->getLocale()}}/wallet/create/{{$currency->id}}">
                            <div class="card info-box-2" style="cursor: pointer;min-height: auto;margin-bottom: 10px">
                                <div class="body mb-0">
                                    <ul class="follow_us list-unstyled mb-0">
                                        <li class="offline">
                                                <div class="media mb-0">
                                                    <img class="media-object " src="{{$currency->thumb}}" alt="">
                                                    <div class="media-body">
                                                        <span class="name">{{ $currency->name }}</span>
                                                        <span class="message">{{ \App\Helpers\Money::instance()->value(0, $currency->symbol, $currency->is_crypto) }}</span>
                                                        <span class="badge badge-outline status"></span>
                                                    </div>
                                                </div>                         
                                        </li>                        
                                    </ul>
                                </div>
                            </div>
                            </a>
                        </div>
                @endforeach
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-round waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="largePaymentLinkFormModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="largeModalLabel">{{__('Payment Request')}}</h6>
            </div>
            <div class="modal-body"> 
                <form method="POST" action="{{url('/')}}/{{app()->getLocale()}}/paymentlink">
                {{csrf_field()}}
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="link_name" placeholder="Name of your link">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="amount" id="link_amount" placeholder="Payment request amount">
                            <span class="form-text ml-2"><small></small></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                         <div class="card " style="box-shadow: none !important; border: 1px solid #e3e3e3;">
                            <div class="body" style="padding: 0">
                                <div class="form-group ">
                                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="Tell your customer why you are requesting this payment" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="col">
                         <input type="submit"  class="btn btn-primary bg-blue btn-round  btn-block" value="{{__('Create Payment Link')}}"//>
                    </div>
                </div>
                </form>

            </div>
            <div class="modal-footer">
               
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="largeVirtualCardFormModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="largeModalLabel">{{__('New Virtual Card')}}</h6>
            </div>
            <div class="modal-body"> 
                <form method="POST" action="{{url('/')}}/{{app()->getLocale()}}/virtualcard">
                {{csrf_field()}}
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="amount" id="card_amount" placeholder="Card amount">
                        </div>
                    </div>
                </div>
                <div class="row d-none" id="errors">
                    <div class="col mt-3">
                        <ul>
                            <li class="text-danger">
                                {{__('The amount must be between USD')}} {{setting('cards.vt_min')}} | {{setting('cards.vt_max')}}
                            </li>
                            <li class="text-danger">
                                The amount must be a valid number
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row" id="card_fees">
                    <div class="col mt-3">
                        <div class="card " style="box-shadow: none !important; border: 1px solid #50d38a;">
                            <div class="body">
                                <div class="row">
                                    <div class="col">
                                        <p class="">
                                           <strong> {{__('Card Creation fee :')}}</strong> <span class="text-primary"> USD </span>  <span id="card_fee"  class="text-primary"> 0.00</span>
                                        </p>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col">
                                        <p class="">
                                           <strong>{{__('Total :')}} </strong> <span  class="text-primary"> USD </span>  <span id="total_card_creation_amount"  class="text-primary"> 0.00</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="pay_card_button">
                    <div class="col">
                         <input type="submit"  class="btn btn-primary bg-blue btn-round  btn-block" value="{{__('Pay')}}"//>
                    </div>
                </div>
                </form>

            </div>
            <div class="modal-footer">
               
            </div>
        </div>
    </div>
</div>
@endauth
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="{{asset('assets/images/logo.svg')}}" width="48" height="48" alt="sQuare"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
@include('layouts.topnavbar')

@include('layouts.aside')
<section class="content">
    <div class="container">
        <div class="row cleatfix">
            <div class="col-lg-12">
                 @yield('pre_content')
            </div>
        </div>
        @auth
        @if(Route::is('show.transfermethods') == false and Route::is('show.createwalletform') == false)
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                   
                    <div class="body block-header">
                        <div class="row">
                            <div class="col">
                                <h2 style="padding-top: 10px">{{__('Welcome back')}} {{ Auth::user()->name }} ! </h2>
                               
                            </div>            
                            <div class="col text-right">
                                <a href="#largeModal" data-toggle="modal" data-target="#largeModal" class="btn btn-primary btn-round bg-blue float-right  m-l-10">{{__('Create a Wallet')}}</a>
                                {{--
                                 <a href="{{route('show.currencies', app()->getLocale())}}" class="btn btn-primary btn-round bg-blue float-right  m-l-10">{{__('Create a Wallet')}}</a>
                                 --}}
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endauth
        @yield('content')
        @auth
        @if(Route::is('show.transfermethods') == false and Route::is('show.createwalletform') == false)
        <div class="row clearfix">
           
        </div>
        @endif
        @endauth
    </div>
      <!-- Scripts -->

    @yield('footer')
</section>
    <!-- Jquery Core Js --> 
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
    <script src="{{ asset('assets/js/vendorscripts.bundle.js')}}"></script> <!-- slimscroll, waves Scripts Plugin Js -->
    <script src="{{ asset('assets/js/morrisscripts.bundle.js')}}"></script><!-- Morris Plugin Js -->
    <script src="{{ asset('assets/js/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('assets/js/knob.bundle.js')}}"></script> <!-- Jquery Knob-->
    <script src="{{ asset('assets/js/mainscripts.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/infobox-1.js')}}"></script>
    <script src="{{ asset('assets/js/index.js')}}"></script>
    @yield('js')
    <script src="{{ asset('assets/js/form-validation.js')}}"></script>
</body>
</html>
