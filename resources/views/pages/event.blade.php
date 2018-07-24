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
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{asset(auth()->user()->avatar)}}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{Auth::user()->name}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                @include('components._usersidebar')
            </div>
        </div>

        @include('components._topnav')

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>List of event</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <form action="{{route('user.list.event.search')}}" method="post">
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
                        @include('components._warnings')
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
                                            <div class="col-xs-12 bottom text-center">
                                                <div class="col-xs-12 col-sm-6 emphasis">
                                                    @role('user')
                                                    <a type="button" class="btn btn-primary btn-xs" href="{{route('user.event.detail', $event)}}">
                                                        <i class="fa fa-eye"> </i> View Detail
                                                    </a>
                                                    @endrole

                                                    @role('organization')
                                                        @if($session == 'detail')
                                                            <a type="button" class="btn btn-primary btn-xs" href="{{route('org.event.detail', $event)}}">
                                                                <i class="fa fa-eye"> </i> View Detail
                                                            </a>
                                                        @endif
                                                        @if($session == 'comment')
                                                            <a type="button" class="btn btn-primary btn-xs" href="{{route('event.comment', $event)}}">
                                                                <i class="fa fa-comment"> </i> View Comment
                                                            </a>
                                                        @endif
                                                        @if($session == 'volunteers')
                                                            <a type="button" class="btn btn-primary btn-xs" href="{{route('manage.volunteer', $event)}}">
                                                                <i class="fa fa-user"> </i> Manage Volunteers
                                                            </a>
                                                        @endif
                                                    @endrole

                                                    @role('admin')
                                                    <a type="button" class="btn btn-primary btn-xs" href="{{route('admin.event.detail', $event)}}">
                                                        <i class="fa fa-eye"> </i> View Detail
                                                    </a>
                                                    @endrole
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
