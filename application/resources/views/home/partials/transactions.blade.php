@if($transactions->total() > 0)
<div class="card user-account">
          <div class="header">
              <h2><strong>Complete</strong>Transactions</h2>
              {{--
              <ul class="header-dropdown">
                  <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                      <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                          <li><a href="javascript:void(0);">Action</a></li>
                          <li><a href="javascript:void(0);">Another action</a></li>
                          <li><a href="javascript:void(0);">Something else</a></li>
                      </ul>
                  </li>
                  <li class="remove">
                      <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                  </li>
              </ul>
              --}}
          </div>
          <div class="body">
              <div class="table-responsive">
                  <table class="table m-b-0">
                      <thead>
                          <tr>
                              <th></th>
                              <th>{{__('Id')}}</th>
                              <th >{{__('Date')}}</th>
                              <th class="hidden-xs">{{__('Name')}}</th>
                              <th class="hidden-xs">{{__('Gross')}}</th>
                              <th class="hidden-xs">{{__('Fee')}}</th>
                              <th>{{__('Net')}}</th>
                              <th>{{__('Balance')}}</th>
                          </tr>
                      </thead>
                      @forelse($transactions as $transaction)
                        <tr>
                          <td><img src="{{$transaction->thumb()}}" alt="" class="rounded" loading="lazy"></td>
                          <td>{{$transaction->id}}<br>{{-- <a href="#" class="button">View</a> --}}</td>
                          <td>{{$transaction->created_at->format('d M Y')}} <br> @include('home.partials.status')</td>
                          <td class="hidden-xs"> @include('home.partials.name')</td>
                          <td class="hidden-xs"><span class="float-right">{{$transaction->gross()}}</span></td>
                          <td class="hidden-xs"> <span class="float-right">{{$transaction->fee()}}</span></td>
                          <td><span class="float-right">{{$transaction->net()}}</span></td>
                          <td><span class="float-right">{{$transaction->balance()}}</span></td>
                        </tr>
                    @empty
                  
                    @endforelse
                  </table>
              </div>
          </div>
          @if($transactions->LastPage() != 1)
            <div class="footer">
                {{$transactions->links()}}
            </div>
          @else
          
          @endif
</div>
@endif
@if($transactions->count() == 0)
  <div class="container">
    <div class="card bg-info">
      <div class="header">
        <h2><i class="zmdi zmdi-alert-circle-o text-white"></i> <strong class="text-white">Info</strong></h2>
          <ul class="header-dropdown">  
              <li class="remove">
                  <a role="button" class="boxs-close "><i class="zmdi zmdi-close text-white"></i></a>
              </li>
          </ul>
      </div>
      <div class="body block-header">
          <div class="row">
              <div class="col">
                  <p class="text-white"><strong> {{__('Your account is Fresh and New !')}} </strong> <br>{{__('Start by requesting money from friends or by selling online and collecting payments in your wallet.')}}</p>
              </div>   
          </div>
      </div>
    </div>
  </div>
@endif