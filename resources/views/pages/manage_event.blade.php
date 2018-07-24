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
                        <div class="table">
                            <table class="table table-hover">
                                <div class="x_content">

                                    <p><strong>List of Volunteers</strong></p>
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">ID </th>
                                        <th class="column-title">Event Name</th>
                                        <th class="column-title">Event Date </th>
                                        <th class="column-title">Created at </th>
                                        <th class="column-title">Status </th>
                                        <th class="column-title">Organizer </th>
                                        <th class="column-title">Delete</th>
                                        <th class="column-title">Edit</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($event as $event)
                                        <tr class="even pointer">
                                            <td class=" ">{{$event->id}}</td>
                                            <td class=" ">{{$event->eventname}}</td>
                                            <td class=" ">{{date('d-M-Y', strtotime($event->eventdate))}}</td>
                                            <td class=" ">{{$event->created_at->diffForHumans()}} </td>
                                            <td class=" ">{{$event->eventstatus}}</td>
                                            <td class=" ">{{$event->users->name}}</td>
                                            <td>
                                                <form class="" action="{{ route('delete.event', $event)}}" method="post">
                                                    {{csrf_field()}}
                                                    <button type="btn" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="" action="{{ route('edit.event', $event)}}" method="post">
                                                    {{csrf_field()}}
                                                    <button type="btn" class="btn btn-warning">Edit</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </div>
                            </table>

                            <div class="clearfix"></div>
                            <a type="button" class="btn btn-primary" href="{{route('admin.add.event')}}">Add Event</a>
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
<!-- Large modal -->

{{--Repair add event--}}

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add User</h4>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('post.register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h1>Create Account</h1>

                    {{-- Name --}}
                    <div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                          </span>
                        @endif
                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" id="name" name="name" required value="{{old('name')}}"  />
                    </div>
                    <br>

                    {{-- username --}}
                    <div>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                          </span>
                        @endif
                        <input type="text" class="form-control{{ $errors->has('Username') ? ' is-invalid' : '' }}" placeholder="Username" id="username" name="username" value="{{old('username')}}" required />
                    </div>
                    <br>

                    {{-- Email --}}
                    <div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @endif
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-Mail" id="email" name="email" value="{{old('email')}}"  required />
                    </div>
                    <br>

                    {{-- Password --}}
                    <div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" id="password" name="password"  required />
                    </div>
                    <br>

                    {{-- Confirm Password --}}
                    <div>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                        @endif
                        <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required />
                    </div>
                    <br>

                    {{-- Phone Number --}}
                    <div>
                        @if ($errors->has('phonenumber'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('phonenumber') }}</strong>
                          </span>
                        @endif
                        <input type="text" class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" placeholder="Phone Number" id="phonenumber" name="phonenumber" value="{{old('phonenumber')}}"  required />
                    </div>
                    <br>


                    {{--User role--}}
                    <div class="form-group">
                        @if ($errors->has('role'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('role') }}</strong>
                          </span>
                        @endif
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="organization">Organization</option>
                            <option value="user">Volunteer</option>
                        </select>
                    </div>
                    <br>

                    {{--file input--}}
                    <div class="form-control">
                        @if ($errors->has('avatar'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('avatar') }}</strong>
                          </span>
                        @endif
                        <input type="file" class="{{ $errors->has('avatar') ? ' is-invalid' : '' }}" placeholder="Profile Picture" id="avatar" name="avatar" value="{{old('avatar')}}" />
                    </div>

                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Record</button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>
{{--Modal end--}}

@extends('partials._script')
<script>
    CKEDITOR.replace( 'reasons' );
</script>
