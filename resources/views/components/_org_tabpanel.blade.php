<div class="col-md-9 col-sm-9 col-xs-12">
    @include('components._warnings')
    <div class="profile_title">
        <div class="col-md-6">
            <h2>Volunteer Event</h2>
        </div>
    </div>

    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">My Event</a>
            </li>
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
                        <th>Submitted at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($event as $event)
                    <tr>
                            <td>{{$event->eventname}}</td>
                            <td>{{date('d-M-Y', strtotime($event->eventdate))}}</td>
                            <td>{{$event->eventstatus}}</td>
                            <td>{{date('d-M-Y', strtotime($event->created_at->diffForHumans()))}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- end recent activity -->
            </div>
        </div>
    </div>
</div>