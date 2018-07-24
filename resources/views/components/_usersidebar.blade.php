<!-- user sidebar menu -->
@role('user')
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li><a href="{{route('user')}}"><i class="fa fa-home" ></i> Home </a>
            </li>
            <li><a><i class="fa fa-edit"></i> Events <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('user.list.event')}}">Events</a></li>
                    <li><a href="{{route('list.attended.event')}}">Attended Events</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-comment"></i>Comments<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('attended.event')}}">Comment Event</a></li>
                    <li><a href="{{route('list.user.comment')}}">My Comment</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-dollar"></i> Donation <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('user.donation')}}">Donation Page</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endrole
<!-- /user sidebar menu -->

<!-- admin sidebar menu -->
@role('admin')
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li>
                <a  href="{{route('admin')}}"><i class="fa fa-home"></i> Home </a>
            </li>
            <li><a><i class="fa fa-users"></i>Manage Users<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('manage.user')}}"> Users </a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Events <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('admin.list.event')}}"> Incoming Events</a></li>
                    <li><a href="{{route('manage.event')}}"> Events</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-external-link"></i> Interests <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('manage.interest')}}">Manage Interest</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-dollar"></i> Donation <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('admin.donation')}}">Donation Page</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endrole
<!-- /admin sidebar menu -->

<!-- organization sidebar menu -->
@role('organization')
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li>
                <a  href="{{route('organization')}}"><i class="fa fa-home"></i> Home </a>
            </li>
            <li><a><i class="fa fa-edit"></i> Events <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('event.form')}}">Create Event</a></li>
                    <li><a href="{{route('org.list.event')}}">List of Events</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-users"></i>Volunteers<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('volunteers.list.event')}}">List of Volunteers</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-comment"></i> Comments<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('comment.list.event')}}">List of Comments</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-dollar"></i> Donation <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('admin.donation')}}">Donation Page</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endrole
<!-- /organization sidebar menu -->

