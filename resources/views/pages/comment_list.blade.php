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

                                    <p><strong>List of Commented Events</strong></p>
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">ID</th>
                                        <th class="column-title">Ratings</th>
                                        <th class="column-title">Event</th>
                                        <th class="column-title">Comment</th>
                                        <th class="column-title">Delete</th>
                                        <th class="column-title">Edit</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($comment as $comment)
                                        <tr class="even pointer">
                                            <td class=" ">{{$comment->id}}</td>
                                            <td class=" ">{{$comment->rating}}</td>
                                            <td class=" ">{{$comment->events->eventname}}</td>
                                            <td class=" ">{!! $comment->comment !!}</td>
                                            <td>
                                                <form method="post" action="{{route('comment.form',$comment->id)}}" onsubmit="return confirm('Are you sure?')">
                                                    {{csrf_field()}}
                                                    <button  type="btn" class="btn btn-danger" >Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="{{route('edit.comment',$comment->id)}}">
                                                    {{csrf_field()}}
                                                    <a href="{{route('edit.comment',$comment->id)}}" type="button" class="btn btn-warning">Edit</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </div>
                            </table>
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
