<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\Event;
use Barryvdh\DomPDF\PDF;


class CommentController extends Controller
{
    public function addComment(Request $request)
    {
//        get user and event id from input
        $userid = Auth::user()->id;
        $eventid = $request->eventid;

//        get the comment from the table
        $comment = DB::table('comments')
            ->where([
            ['eventid','=',$eventid],
            ['userid','=',$userid],
        ])->count();

//        spam prevention
//        if user already comment to the event
//        prevent the comment
        if($comment >= 1)
        {
            return redirect()->route('attended.event')->with('comment_repeat','you have commented to this event');
        }

        else
        {
            Comment::create([
                'userid'=>$userid,
                'eventid'=>$eventid,
                'comment'=>$request->editor1,
                'rating'=>$request->stars
            ]);

            Registration::where([
                ['eventid','=',$eventid],
                ['userid','=',$userid]
            ])->update([
                'status'=>'commented'
            ]);

            $avg = Comment::where('eventid',$eventid)->avg('rating');
            $ratedevent = Event::where('id', $eventid);

            $ratedevent->update([
                'ratings'=> $avg
            ]);

            return redirect()->route('attended.event')->with('comment_approved','you comment has been recorded');
        }

    }

    public function attendedEvent()
    {
        $user = User::find(Auth::user()->id);

        if ($user->hasRole('user'))
        {
//          get the user id
            $id = Auth::id();
//          get attended event
            $attended = Registration::with('events')
                ->where([
                    ['status','=', 'attended'],
                    ['userid', '=', $id],
                ])
                ->orWhere([
                    ['userid', '=', $id],
                    ['status','=', 'commented']
                ])
                ->get();
            return view('pages.attended_event', compact('attended'));
        }

        elseif ($user->hasRole('organization'))
        {
            $id = Auth::id();
            $event = Event::where('userid','=',$id)->get();
            return view('pages.profile', compact('event'));
        }
    }

    public function commentForm(Registration $attended)
    {
        return view('pages.comment_form', compact('attended'));
    }

    public function listComment(Event $event)
    {
        $id = $event->id;
        $comment = Comment::with('users')->where('eventid', $id)->get();
        $session = 'comment';
        return view('pages.event_detail', compact('event','comment', 'session'));
    }

    public function userComment()
    {
        $id = Auth::user()->id;
        $comment = Comment::with('events')->where('userid', $id)->get();
        return view('pages.comment_list', compact('comment'));
    }

    public function editComment(Comment $comment)
    {
        return view('pages.edit_comment_form', compact('comment'));
    }

    public function updateComment(Comment $comment, Request $request)
    {
//        dd($request);
        $comment->update([
           'rating'=>$request->stars,
           'comment'=>$request->editor1,
        ]);

        $eventid = $request->eventid;




        $avg = Comment::where('eventid',$eventid)->avg('rating');

        $ratedevent = Event::where('id', $eventid);

        $ratedevent->update([
            'ratings'=> $avg
        ]);


        return redirect()->route('list.user.comment')->with('update_recorded','your update has been recorded');
    }

    public function deleteComment(Comment $comment)
    {
//        dd($request);
        $comment->delete();

        $eventid = $comment->eventid;

        $avg = Comment::where('eventid',$eventid)->avg('rating');
        $ratedevent = Event::where('id', $eventid);

        $ratedevent->update([
            'ratings'=> $avg
        ]);


        return redirect()->route('list.user.comment')->with('delete_recorded','your update has been recorded');
    }
}
