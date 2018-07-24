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
                        <img src="{{asset(auth()->user()->avatar)}}" alt="profile" class="img-circle profile_img" height="60" width="50">
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
            @role('admin')
                @include('components._stats')
            @endrole
            <div class="">
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>User Report <small>Activity report</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                    <div class="profile_img">
                                        <div id="crop-avatar">
                                            <!-- Current avatar -->
                                            <img class="img-responsive avatar-view" src="{{asset(auth()->user()->avatar)}}" alt="Avatar" title="Change the avatar" height="280" width="260">
                                        </div>
                                    </div>
                                    <h3>{{Auth::user()->name}}</h3>


                                    {{--User Data--}}
                                    <ul class="list-unstyled user_data">
                                        <li><i class="fa fa-phone user-profile-icon"></i> {{Auth::user()->phone}}
                                        </li>

                                        <li>
                                            <i class="fa fa-briefcase user-profile-icon"></i> {{Auth::user()->ocupation}}
                                        </li>

                                        <li class="m-top-xs">
                                            <i class="fa fa-external-link user-profile-icon"></i> {{Auth::user()->interest}}
                                        </li>
                                    </ul>
                                    @foreach($user as $user)
                                        @role('admin')
                                        <form class="" action="{{ route('admin.edit.user', $user)}}" method="get">
                                            {{csrf_field()}}
                                            <a  href="{{ route('admin.edit.user', $user)}}" type="button" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                                        </form>
                                        @endrole
                                        @role('organization')
                                        <form class="" action="{{ route('organization.edit.user', $user)}}" method="get">
                                            {{csrf_field()}}
                                            <a  href="{{ route('organization.edit.user', $user)}}" type="button" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                                        </form>
                                        @endrole
                                        @role('user')
                                        <form class="" action="{{ route('volunteer.edit.user', $user)}}" method="get">
                                            {{csrf_field()}}
                                            <a href="{{ route('volunteer.edit.user', $user)}}" type="button" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                                        </form>
                                        @endrole
                                    @endforeach
                                    <br />
                                </div>

                                @role('admin')
                                    @include('components._admin_tabpanel')
                                @endrole

                                @role('user')
                                    @include('components._user_tabpanel')
                                @endrole

                                @role('organization')
                                    @include('components._org_tabpanel')
                                @endrole
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
<script>
    CKEDITOR.replace( 'comment' );
</script>
