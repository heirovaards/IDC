<div class="col-md-9 col-sm-9 col-xs-12">
    @include('components._warnings')
    <div class="profile_title">
        <div class="col-md-6">
            <h2>Admin Dashboard</h2>
        </div>
    </div>

    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Incoming Events</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">New User</a>
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
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($pending as $pending)
                            <td>{{$pending->eventname}}</td>
                            <td>{{date('d-M-Y', strtotime($pending->eventdate))}}</td>
                            <td>{{($pending->status)}}</td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
                <!-- end recent activity -->
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                <!-- start user projects -->
                <table class="data table table-striped no-margin">
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Registration date</th>
                        <th>User Interest</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($newuser as $newuser)
                        <tr>
                            <td>{{$newuser->name}}</td>
                            <td>{{$newuser->created_at->diffForHumans()}}</td>
                            @foreach($newuser->Roles as $role)
                                <td class=" ">{{$role->name}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- end user projects -->
            </div>
        </div>
    </div>
</div>