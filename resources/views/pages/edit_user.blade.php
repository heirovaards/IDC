@include('partials._head')

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
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
                {{--search bar--}}

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                    <h2>Edit user</h2>

                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                @foreach($edituser as $edituser)
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{route('update.user', $edituser)}}" enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User ID <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" class="form-control col-md-7 col-xs-12" value="{{$edituser->id}}" disabled>
                                            <input type="hidden"name="id" value="{{$edituser->id}}">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="{{--xdisplay_inputx form-group has-feedback--}}">
                                                        <input type="text" class="form-control t"  placeholder="Event Date" name="name" value="{{$edituser->name}}" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Username <span class="required">*</span>
                                        </label>
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('pusername') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text"  name="username" class="form-control col-md-7 col-xs-12" value="{{$edituser->username}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span>
                                        </label>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text"  name="email" class="form-control col-md-7 col-xs-12" value="{{$edituser->email}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Phone Number <span class="required">*</span>
                                        </label>
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text"  name="phone" class="form-control col-md-7 col-xs-12" value="{{$edituser->phone}}">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Interest <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="interest_id">
                                                @foreach ($interest as $interest)
                                                    {{--Taking Data From table Category and ID attribute--}}
                                                    <option value="{{ $interest->interest}}"> {{ $interest->interest }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Current Avatar <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <img src="{{asset($edituser->avatar)}}" class="col-md-7 col-xs-12" width="150" height="200">
                                            <input type="hidden" value="{{$edituser->avatar}}" name="oldavatar">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Avatar
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file"  class="form-group col-md-7 col-xs-12" name="avatar">
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-danger" type="reset">Reset</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>

                                </form>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

        <script>
            CKEDITOR.replace( 'editor1' );
        </script>
        <!-- /page content -->
@extends('partials._script')
