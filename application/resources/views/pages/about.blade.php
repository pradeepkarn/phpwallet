@extends('layouts.app')

@section('content') 
 {{-- @include('partials.nav')  --}}

    <div class="row">
    	<div class="col">
       <h4 class="ml-5">{{_('About')}} {{ setting('site.title') }}</h4>
       </div>
    </div>
    <div class="row">
    	<div class="col">
       <img src="{{}}" alt="">
       </div>
    </div>
    <div class="row">
    	<div class="col">
        <div class="card">
          <div class="header">
             
          </div>
          <div class="body">
                                      
              <div class="col">
              {!! setting('pages.about') !!}
             </div>

          </div>
        </div>
      </div>
    </div>
@endsection

@section('footer')
	@include('partials.footer')
@endsection
