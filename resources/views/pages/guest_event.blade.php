@include('partials._head')

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a class="site_title"><i class="fa fa-heart"></i> <span>IDrugC</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <!-- /menu profile quick info -->

                <br />

                @include('components._guestsidebar')
            </div>
        </div>


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>List of event</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <form action="{{route('guest.search')}}" method="post">
                                {{csrf_field()}}
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for..." name="search">
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="submit">Go!</button>
                                </span>
                            </div>
                            </form>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <form action="{{route('user.list.event.search')}}" method="post">
                                {{csrf_field()}}
                                <div class="input-group">
                                    <input type="date" class="form-control" placeholder="Search for..." name="search">
                                    <span class="input-group-btn">
                                  <button class="btn btn-default" type="submit">Go!</button>
                                </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        {!! $event->render() !!}
                                    </div>

                                    <div class="clearfix"></div>

                                    @foreach($event as $event)
                                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief"><i>{{$event->eventname}}</i></h4>
                                                <div class="left col-xs-7">
                                                    <p><strong>Organizer: </strong> {{$event->users->name}} </p>
                                                    <ul class="list-unstyled">
                                                        <li><i class="fa fa-building"></i><strong> Address:</strong> {{$event->eventaddress}}, {{$event->eventdistrict}}, {{$event->eventcity}}, {{$event->eventstate}} </li>
                                                        <li><i class="fa fa-calendar"></i><strong> Date:</strong> {{date('d-M-Y', strtotime($event->eventdate))}} </li>
                                                        <li><i class="fa fa-flag"></i><strong> Requested:</strong> {{$event->created_at->diffForHumans()}} </li>
                                                    </ul>
                                                </div>
                                                <div class="right col-xs-5 text-center">
                                                    <img src="{{asset($event->poster)}}" alt="" class="img-responsive" height="80" width="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
@extends('partials._script')
