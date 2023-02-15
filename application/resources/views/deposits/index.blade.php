@extends('layouts.app')

@section('content')
{{-- @include('partials.nav') --}}
    <div class="row">
        @include('partials.sidebar')
		 <div class="col-lg-9 col-md-12">
        <div class="row">
      		<div class="col">
              
      	        @if($deposits->total()>0)
                <div class="card">
                  <div class="header">
                      <h2><strong>{{__('My Deposits')}}</strong></h2>
                      
                  </div>
                  <div class="body">
                    <div class="table-responsive">
                      <table class="table table-striped"  style="margin-bottom: 0;">
                        <thead>
                          <tr>
                            <th>{{__('Receipt')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Method')}}</th>
                            <th>{{__('Gross')}}</th>
                            <th>{{__('Fee')}}</th>
                            <th>{{__('Net')}}</th>
                            <th>{{__('Unique transaction id')}}</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($deposits as $deposit)
                            <tr>
                              <td><a href="{{$deposit->transaction_receipt}}" target="blank"><img src="{{$deposit->transaction_receipt}}" alt="" class="rounded" loading="lazy" style="width: 50px"></a></td>
                              <td>{{$deposit->created_at->format('d M Y')}} <br> @include ('deposits.partials.status')</td>
                              <td>{{$deposit->transferMethod->name}}</td>
                              <td>{{$deposit->gross()}}</td>
                              <td>{{$deposit->fee()}}</td>
                              <td>{{$deposit->net()}}</td>
                               <td>{{$deposit->unique_transaction_id}}</td>
                            </tr>
                          @empty
                          
                          @endforelse
                        </tbody>
                      </table>                          
                    </div> 
                  </div>
                  @if($deposits->LastPage() != 1)
                    <div class="footer">
                        {{$deposits->links()}}
                    </div>
                  @else
                  @endif
              </div>
                @endif

                @if($deposits->total() == 0)
                  <div class="container">
                    <div class="card bg-light">
                      <div class="header">
                        <h2><strong class=""><i class="zmdi zmdi-alert-circle-o "></i></strong> Info</h2>
                          <ul class="header-dropdown">  
                              <li class="remove">
                                  <a role="button" class="boxs-close "><i class="zmdi zmdi-close "></i></a>
                              </li>
                          </ul>
                      </div>
                      <div class="body block-header">
                          <div class="row">
                              <div class="col">
                                  <p class=""><strong> {{__('Your account is Fresh and New !')}} </strong> <br>{{__('Start by adding credit to your wallet to spend online with friends and family.')}}</p>
                              </div>   
                          </div>
                          <div class="col">
                            <a class="btn btn-primary btn-round bg-blue mb-3" href="{{url('/')}}/{{app()->getLocale()}}/deposit/{{Auth::user()->currentWallet()->id}}">{{__('Choose your prefered deposit method')}}</a>
                          </div>
                      </div>
                    </div>
                  </div>
                @endif

          	</div>
          </div>
        </div>
    </div>

@endsection

@section('footer')
  @include('partials.footer')
@endsection