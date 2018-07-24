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
                            @include('components._warnings')
                            <table class="table table-hover">
                                <div class="x_content">

                                    <p><strong>List of Volunteers</strong></p>
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">ID </th>
                                        <th class="column-title">Interest</th>
                                        <th class="column-title">Created at </th>
                                        <th class="column-title">Delete</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($interest as $interest)
                                        <tr class="even pointer">
                                            <td class=" ">{{$interest->id}}</td>
                                            <td class=" ">{{$interest->interest}}</td>
                                            <td class=" ">{{$interest->created_at->diffForHumans()}} </td>
                                            <td>
                                                <form class="" action="{{ route('delete.interest', $interest)}}" method="post">
                                                    {{csrf_field()}}
                                                    <button type="btn" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </div>
                            </table>

                            <div class="clearfix"></div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Comment</button>
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

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Interest</h4>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('add.interest') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    {{-- Name --}}
                    <div>
                        @if ($errors->has('interest'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('interest') }}</strong>
                          </span>
                        @endif
                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Interest" id="name" name="interest" required value="{{old('name')}}"  />
                    </div>
                    <br>

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
