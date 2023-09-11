@extends('toppilot::layouts.frontend')

@section('title', 'TopPilot')

@section('content')
<div class="row">
    <div class="card col-md-4 col-lg-4 bg-secondary text-white">
        <div class="card-header mt-3 mb-3">{{ config('toppilot.name') }} - By ParKho</div>
    </div>
</div>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active mr-1" id="flighttime-tab" data-toggle="tab" data-target="#flighttime" type="button" role="tab" aria-controls="nav-flighttime" aria-selected="true">Top Pilots Flight Time</button>
    <button class="nav-link mr-1" id="distance-tab" data-toggle="tab" data-target="#distance" type="button" role="tab" aria-controls="nav-distance" aria-selected="false">Top Pilots Distance</button>
    <button class="nav-link mr-1" id="nav-landingrate-tab" data-toggle="tab" data-target="#landingrate" type="button" role="tab" aria-controls="nav-landingrate" aria-selected="false">Top Pilots Landing Rate</button>
    <button class="nav-link mr-1" id="nav-bestrevenue-tab" data-toggle="tab" data-target="#bestrevenue" type="button" role="tab" aria-controls="nav-bestrevenue" aria-selected="false">Top Pilots Best Revenue</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="flighttime" role="tabpanel" aria-labelledby="flighttime-tab">
        <div class="row">
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">Today - {{ $DayName }}, {{ $Month }} {{ $Day }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Flight Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($resultftDay as $res)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                    <td>{{ $res->user->name_private }}</td>
                                    <td>{{ $res->user->curr_airport_id }}</td>
                                    <td class="text-success">@minutestotime($res->totaltime)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">Week {{ $Week }} of {{ $Month }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Flight Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultftWeek as $res)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                    <td>{{ $res->user->name_private }}</td>
                                    <td>{{ $res->user->curr_airport_id }}</td>
                                    <td class="text-success">@minutestotime($res->totaltime)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">In {{ $Month }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Flight Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultftMonth as $res)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                    <td>{{ $res->user->name_private }}</td>
                                    <td>{{ $res->user->curr_airport_id }}</td>
                                    <td class="text-success">@minutestotime($res->totaltime)</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">In Year {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Flight Time</th>
                            </tr>
                            @if(!$resultftYear)
                                
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                            @else 
                                @foreach($resultftYear as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                        <td>{{ $res->user->name_private }}</td>
                                        <td>{{ $res->user->curr_airport_id }}</td>
                                        <td class="text-success">@minutestotime($res->totaltime)</td>
                                    </tr>
                                @endforeach                            
                            @endif
                                
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-12 col-lg-12">
                <div class="card-header mt-3 mb-3">In Year {{ $LastYear }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Flight Time</th>
                            </tr>
                            @if(!$resultftLastYear)
                                
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                            @else 
                                @foreach($resultftLastYear as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                        <td>{{ $res->user->name_private }}</td>
                                        <td>{{ $res->user->curr_airport_id }}</td>
                                        <td class="text-success">@minutestotime($res->totaltime)</td>
                                    </tr>
                                @endforeach                            
                            @endif
                                
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade show" id="distance" role="tabpanel" aria-labelledby="distance tab-tab">
        <div class="row">
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">Today - {{ $DayName }}, {{ $Month }} {{ $Day }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Distance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$resultftLastYear)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                            @else 
                                @foreach($resultdDay as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                        <td>{{ $res->user->name_private }}</td>
                                        <td>{{ $res->user->curr_airport_id }}</td>
                                        <td class="text-success">{{ floor($res->totaldistance) }} NM</td>
                                    </tr>
                                @endforeach                            
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">Week {{ $Week }} of {{ $Month }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Distance</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$resultftLastYear)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                            @else 
                                @foreach($resultdDay as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                        <td>{{ $res->user->name_private }}</td>
                                        <td>{{ $res->user->curr_airport_id }}</td>
                                        <td class="text-success">{{ floor($res->totaldistance) }} NM</td>
                                    </tr>
                                @endforeach                            
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">In {{ $Month }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Flight Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultdMonth as $res)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                    <td>{{ $res->user->name_private }}</td>
                                    <td>{{ $res->user->curr_airport_id }}</td>
                                    <td class="text-success">{{ floor($res->totaldistance) }} NM</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">In Year {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Distance</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$resultdLastYear)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                            @else 
                                @foreach($resultdYear as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                        <td>{{ $res->user->name_private }}</td>
                                        <td>{{ $res->user->curr_airport_id }}</td>                              
                                        <td class="text-success">{{ floor($res->totaldistance) }} NM</td>
                                    </tr>
                                @endforeach                            
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-12 col-lg-12">
                <div class="card-header mt-3 mb-3">In Year {{ $LastYear }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Flight Time</th>
                            </tr>
                            @if(!$resultdLastYear)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                            @else 
                                @foreach($resultdLastYear as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                        <td>{{ $res->user->name_private }}</td>
                                        <td>{{ $res->user->curr_airport_id }}</td>
                                        <td class="text-success">{{ floor($res->totaldistance) }} NM</td>
                                    </tr>
                                @endforeach                            
                            @endif
                                
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade show" id="landingrate" role="tabpanel" aria-labelledby="landingrate tab-tab">
        <div class="row">
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">Today - {{ $DayName }}, {{ $Month }} {{ $Day }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Landing Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$resultlrDay)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                            @else 
                                @foreach($resultlrDay as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                        <td>{{ $res->user->name_private }}</td>
                                        <td>{{ $res->user->curr_airport_id }}</td>
                                        <td class="text-success">{{ floor($res->landing_rate) }} fps</td>
                                    </tr>
                                @endforeach                            
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">Week {{ $Week }} of {{ $Month }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Landing Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$resultlrWeek)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                            @else 
                                @foreach($resultlrWeek as $res)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                        <td>{{ $res->user->name_private }}</td>
                                        <td>{{ $res->user->curr_airport_id }}</td>
                                        <td class="text-success">{{ floor($res->landing_rate) }} fps</td>
                                    </tr>
                                @endforeach                            
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">In {{ $Month }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered"> 
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Landing Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(!$resultlrMonth)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                                @else 
                                    @foreach($resultlrMonth as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                            <td>{{ $res->user->name_private }}</td>
                                            <td>{{ $res->user->curr_airport_id }}</td>
                                            <td>{{ floor($res->landing_rate) }} fps</td>
                                        </tr>
                                    @endforeach                            
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">This Year {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Landing Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(!$resultlrYear)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                                @else 
                                    @foreach($resultlrYear as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                            <td>{{ $res->user->name_private }}</td>
                                            <td>{{ $res->user->curr_airport_id }}</td>
                                            <td class="text-success">{{ floor($res->landing_rate) }} fps</td>
                                        </tr>
                                    @endforeach                            
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-12 col-lg-12">
                <div class="card-header mt-3 mb-3">In Year {{ $LastYear }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Landing Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(!$resultlrLastYear)
                                    
                                    <tr><td colspan="3" align="center">No Records Found</td></tr>
                                
                                @else 
                                    @foreach($resultlrLastYear as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('frontend.users.show.public', [$res->user->id]) }}">{{$res->user->ident}}</a></td>
                                            <td>{{ $res->user->name_private }}</td>
                                            <td>{{ $res->user->curr_airport_id }}</td>
                                            <td class="text-success">{{ floor($res->landing_rate) }} fps</td>
                                        </tr>
                                    @endforeach                            
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade show" id="bestrevenue" role="tabpanel" aria-labelledby="bestrevenue tab-tab">
        <div class="row">
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">Today - {{ $DayName }}, {{ $Month }} {{ $Day }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Best Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(!$resultbrDay)
                                <tr><td colspan="3" align="center">No Records Found</td></tr>
                                @else 
                                    @foreach($resultbrDay as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('frontend.users.show.public', [$res['user']['user_id']]) }}">{{ $res['user']['airline_code'] }}000{{ $res['user']['user_id'] }}</a></td>
                                            <td>{{ $res['user']['name'] }}</td>
                                            <td>{{ $res['user']['curr_airport_id'] }}</td>
                                            <td class="text-success">{{ money($res['total_balance'], $curr_unit) }}</td>
                                        </tr>
                                    @endforeach                            
                                @endif


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">Week {{ $Week }} of {{ $Month }}, {{ $Year }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Best Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(!$resultbrWeek)
                                <tr><td colspan="3" align="center">No Records Found</td></tr>
                                @else 
                                    @foreach($resultbrWeek as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('frontend.users.show.public', [$res['user']['user_id']]) }}">{{ $res['user']['airline_code'] }}000{{ $res['user']['user_id'] }}</a></td>
                                            <td>{{ $res['user']['name'] }}</td>
                                            <td>{{ $res['user']['curr_airport_id'] }}</td>
                                            <td class="text-success">{{ money($res['total_balance'], $curr_unit) }}</td>
                                        </tr>
                                    @endforeach                            
                                @endif


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">In {{ $Month }}, {{ $Year }}</div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Best Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(!$resultbrMonth)
                                <tr><td colspan="3" align="center">No Records Found</td></tr>
                                @else 
                                    @foreach($resultbrMonth as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('frontend.users.show.public', [$res['user']['user_id']]) }}">{{ $res['user']['airline_code'] }}000{{ $res['user']['user_id'] }}</a></td>
                                            <td>{{ $res['user']['name'] }}</td>
                                            <td>{{ $res['user']['curr_airport_id'] }}</td>
                                            <td class="text-success">{{ money($res['total_balance'], $curr_unit) }}</td>
                                        </tr>
                                    @endforeach                            
                                @endif


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-6 col-lg-6">
                <div class="card-header mt-3 mb-3">This Year - {{ $Year }}</div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Best Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(!$resultbrYear)
                                <tr><td colspan="3" align="center">No Records Found</td></tr>
                                @else 
                                    @foreach($resultbrYear as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('frontend.users.show.public', [$res['user']['user_id']]) }}">{{ $res['user']['airline_code'] }}000{{ $res['user']['user_id'] }}</a></td>
                                            <td>{{ $res['user']['name'] }}</td>
                                            <td>{{ $res['user']['curr_airport_id'] }}</td>
                                            <td class="text-success">{{ money($res['total_balance'], $curr_unit) }}</td>
                                        </tr>
                                    @endforeach                            
                                @endif


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card col-md-12 col-lg-12">
                <div class="card-header mt-3 mb-3">In {{ $LastYear }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Pilot ID</th>
                                <th>Name</th>
                                <th>Current Location</th>
                                <th>Best Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(!$resultbrLastYear)
                                <tr><td colspan="3" align="center">No Records Found</td></tr>
                                @else 
                                    @foreach($resultbrLastYear as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('frontend.users.show.public', [$res['user']['user_id']]) }}">{{ $res['user']['airline_code'] }}000{{ $res['user']['user_id'] }}</a></td>
                                            <td>{{ $res['user']['name'] }}</td>
                                            <td>{{ $res['user']['curr_airport_id'] }}</td>
                                            <td class="text-success">{{ money($res['total_balance'], $curr_unit) }}</td>
                                        </tr>
                                    @endforeach                            
                                @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
