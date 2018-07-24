<div class="">
    <h2><strong><i class="fa fa-user"></i><a href="#"> Event Ratings</a> </strong></h2>
    <ul class="list-inline prod_color">
        <li>
            <p>
                <a href="#">
                    {{$event->ratings}}
                </a>
            </p>
        </li>
    </ul>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Volunteers Comment </h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <ul class="list-unstyled timeline">
            @foreach($comment as $comment)
            <li>
                <div class="block">
                    <div class="tags">
                        <a href="" class="tag">
                            <span class="fa fa-star"> {{$comment->rating }}</span>
                        </a>
                    </div>
                    <div class="block_content">
                        <h2 class="title">
                            Comment By : {{$comment->users->name}}
                        </h2>
                        <div class="byline">
                            <span>{{$comment->created_at->diffForHumans()}}</span>
                        </div>
                        {!! $comment->comment !!}
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

    </div>
</div>