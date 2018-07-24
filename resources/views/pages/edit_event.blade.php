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
                {{--search bar--}}

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Create Event Form</h2>
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
                                @foreach($editevent as $editevent)
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{route('update.event', $editevent->id)}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Event Name <span class="required">*</span>
                                        </label>
                                        @if ($errors->has('eventname'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('eventname') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="eventname" value="{{$editevent->eventname}}" >
                                            <input type="hidden" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="id" value="{{$editevent->id}}">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Event Date <span class="required">*</span></label>
                                        @if ($errors->has('eventdate'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('eventdate') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="{{--xdisplay_inputx form-group has-feedback--}}">
                                                        <input type="date" class="form-control t"  placeholder="Event Date" name="eventdate" value="{{$editevent->eventdate}}" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        @if ($errors->has('editor1'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('editor1') }}</strong>
                                          </span>
                                        @endif
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Event Detail <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea name="editor1" class="form-control" placeholder="Page Body"  >{!!  $editevent->eventdetail!!}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Event Interest<span class="required">*</span>
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Event Province <span class="required">*</span>
                                        </label>
                                        @if ($errors->has('provice'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('province') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text"  name="province" required="required" class="form-control col-md-7 col-xs-12" value="{{$editevent->eventstate}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Event City <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" required="required" class="form-control col-md-7 col-xs-12" name="city" value="{{$editevent->eventcity}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Event district <span class="required">*</span>
                                        </label>
                                        @if ($errors->has('district'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('district') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text"  required="required" class="form-control col-md-7 col-xs-12" name="district" value="{{ $editevent->eventdistrict}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Event address <span class="required">*</span>
                                        </label>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                          </span>
                                        @endif
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" required="required" class="form-control col-md-7 col-xs-12" name="address" value="{{ $editevent->eventaddress}}">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Current Poster <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <img src="{{asset($editevent->poster)}}" class="col-md-7 col-xs-12">
                                            <input type="hidden" value="{{$editevent->poster}}" name="oldavatar">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Poster
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file"  class="form-group col-md-7 col-xs-12" name="poster">
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

