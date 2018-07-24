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

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @include('components._warnings')
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Event Details</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="product-image">
                                        <img src="{{asset($event->poster)}}" alt="..." />
                                    </div>
                                </div>

                                <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                                    <h3 class="prod_title">{{$event->eventname}}</h3>
                                    @role('admin')
                                    <h6>Submitted at</h6> {{date('d-M-Y', strtotime($event->created_at))}} ({{$event->created_at->diffForHumans()}})
                                    @endrole

                                    @role('user')
                                    <h6>Published at</h6> {{date('d-M-Y', strtotime($event->updated_at))}} ({{$event->created_at->diffForHumans()}})
                                    @endrole

                                    <div class="">
                                        <div class="product_price">
                                            <h4><strong><i class="fa fa-file"></i> Event Details </strong></h4>
                                            <p>
                                                {!!$event->eventdetail!!}
                                            </p>
                                            <br>
                                        </div>
                                    </div>
                                    <br />

                                    <div class="">
                                        <h2><strong><i class="fa fa-map-marker"></i> Event Address</strong></h2>
                                        <ul class="list-inline prod_color">
                                            <li>
                                                <p>{{$event->eventaddress}}, {{$event->eventdistrict}}, {{$event->eventcity}}, {{$event->eventstate}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <br />

                                    <div class="">
                                        <h2><strong><i class="fa fa-calendar"></i> Event Date</strong></h2>
                                        <ul class="list-inline prod_color">
                                            <li>
                                               <p> {{date('d-M-Y', strtotime($event->eventdate))}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <br />

                                    <div class="">
                                        <h2><strong><i class="fa fa-check-circle"></i> Event Interest</strong></h2>
                                        <ul class="list-inline prod_color">
                                            <li>
                                                <p> {{$event->interest}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <br />

                                    <div class="">
                                        <h2><strong><i class="fa fa-user"></i><a href="#"> Event Organizer</a> </strong></h2>
                                        <ul class="list-inline prod_color">
                                            <li>
                                               <p>
                                                   <a href="#">
                                                       {{$event->users->name}}
                                                   </a>
                                               </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <br />

                                    @role('admin')
                                    <div class="">
                                        <form method="post" action="{{route('event.approval', $event->id)}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <button type="submit" class="btn btn-success btn-lg" name="approval" value="approved">Approve</button>
                                            <button type="submit" class="btn btn-danger btn-lg" name="approval" value="rejected">Reject</button>
                                            <br>
                                            <label class="">Reason <span class="required">*</span></label>
                                            <textarea name="reasons" class="form-control" placeholder="Reason"></textarea>
                                        </form>
                                    </div>
                                    @endrole

                                    @role('user')
                                    {{--compact registration, remove this for printing certificate--}}
                                    <div class="">

                                        <form method="post" action="{{route('event.register', $event->id)}}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                        </form>
                                    </div>
                                    @endrole

                                    @role('organization')
                                        @if($event->eventstatus === 'pending')
                                            <div class="">
                                                <form method="post" action="{{route('org.edit.event', $event->id)}}">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-warning btn-lg">Edit</button>
                                                </form>
                                            </div>
                                        @endif
                                        @if($session == 'comment')
                                         @include('components._comment')
                                        @endif
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
        <!-- /page content -->
@extends('partials._script')
        <script>
            CKEDITOR.replace( 'reasons' );
        </script>
