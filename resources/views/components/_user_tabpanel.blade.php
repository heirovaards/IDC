<div class="col-md-9 col-sm-9 col-xs-12">
    @include('components._warnings')
    <div class="profile_title">
        <div class="col-md-6">
            <h2>Volunteer Event</h2>
        </div>
    </div>

    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Attended Event</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Registered Event</a>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                <!-- start recent activity -->

                <table class="data table table-striped no-margin">
                    <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Event Date</th>
                        <th>Status</th>
                        <th>Attended</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attended as $attended)
                        <tr>

                            <td>{{$attended->events->eventname}}</td>
                            <td>{{date('d-M-Y', strtotime($attended->events->eventdate))}}</td>
                            <td>{{($attended->status)}}</td>
                            <td>
                                <form method="post" action="{{route('comment.form',$attended->id)}}">
                                     <a href="{{route('comment.form',$attended->id)}}" type="button" class="btn btn-primary">Comment</a>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- end recent activity -->
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                <!-- start user projects -->
                <table class="data table table-striped no-margin">
                    <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Event Date</th>
                        <th>Registration date</th>
                        <th>Event Location</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($event as $event)
                            <tr>
                                <td>{{$event->events->eventname}}</td>
                                <td>{{date('d-M-Y', strtotime($event->events->eventdate))}}</td>
                                <td>{{date('d-M-Y', strtotime($event->created_at))}} ({{$event->created_at->diffForHumans()}})</td>
                                <td>{{$event->events->eventaddress}}, {{$event->events->eventdistrict}}, {{$event->events->eventcity}}, {{$event->events->eventstate}}</td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- end user projects -->
            </div>
        </div>
    </div>
</div>

