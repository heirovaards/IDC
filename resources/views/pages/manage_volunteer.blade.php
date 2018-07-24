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

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>List of Registered Volunteer | <small>event name : {{$event->eventname}}</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">


                                <form action="{{route('attend.event')}}" method="post">
                                    {{csrf_field()}}
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <tr class="headings">
                                            <th>

                                            </th>
                                            <th class="column-title">Registration ID </th>
                                            <th class="column-title">User Name </th>
                                            <th class="column-title">Registration Date </th>
                                            <th class="column-title">Event Date </th>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($user as $user)
                                        <tr class="even pointer">
                                            <td class="a-center ">
                                                <input type="checkbox"  name="id[]" value="{{$user->id}}">
                                            </td>
                                            <td class=" ">{{$user->id}}</td>
                                            <td class=" ">{{$user->users->name}}</td>
                                            <td class=" ">{{$user->created_at->diffForHumans()}}</td>
                                            <td class=" ">{{$event->eventdate}}</td>
                                            </td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                    <div class="clearfix"></div>
                                    <button class="btn btn-primary" type="submit">Submit</button>

                                </div>
                                </form>
                                <form method="get" action="{{route('print.attendance', $event->id)}}">
                                    {{csrf_field()}}
                                    <button type="btn" href="{{route('print.attendance', $event->id)}}" class="btn btn-primary"><span class="fa fa-print"> Print</span></button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- /page content -->
    </div>
</div>
</body>
@extends('partials._script')
<script>
    CKEDITOR.replace( 'reasons' );
</script>
