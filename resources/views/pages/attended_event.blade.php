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
                <div class="row"></div>
                <div class="col-md-12 col-sm-12 col-xs-1">
                    <div class="x_panel">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        @include('components._warnings')
                        <div class="table">
                            <table class="table table-hover">
                                <div class="x_content">

                                    <p><strong>List of Attended Event</strong></p>
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">Event Name</th>
                                        <th class="column-title">Event Date </th>
                                        <th class="column-title">Registration Status</th>
                                        <th class="column-title">Comment</th>
                                        <th class="column-title">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($attended as $attended)
                                        <tr class="even pointer">
                                            <td class=" ">{{$attended->events->eventname}}</td>
                                            <td class=" ">{{date('d-M-Y', strtotime($attended->events->eventdate))}}</td>
                                            <td class=" ">{{$attended->status}}</td>
                                            <td>
                                                @if($attended->status != 'commented')
                                                    <form method="post" action="{{route('comment.form',$attended->id)}}">
                                                        <a href="{{route('comment.form',$attended->id)}}" type="button" class="btn btn-primary">Comment</a>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="">
                                                    <form method="post" action="{{route('print.certificate')}}">
                                                        {{csrf_field()}}
                                                        <input type="hidden" value="{{Auth::user()->id}}" name="userid">
                                                        <input type="hidden" value="{{$attended->events->id}}" name="eventid">
                                                        <button type="submit" class="btn btn-primary"><span class="fa fa-print"> Print Certificate</span></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </div>
                            </table>
                            @role('user')
                                <form method="post" action="{{route('print.report')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{Auth::user()->id}}" name="userid">
                                    <button type="submit" class="btn btn-primary"><span class="fa fa-print"> Print</span></button>
                                </form>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
</div>
</body>

@extends('partials._script')
<script>
    CKEDITOR.replace( 'reasons' );
</script>
