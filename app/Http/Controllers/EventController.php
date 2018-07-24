<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Interest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Registration;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{

    public function getEvents()
    {

//      redirect user role
//      get approved event only
        $user = User::find(Auth::user()->id);
        if ($user->hasRole('user'))
        {
//          getting value of Event table and user table using Eloquent
            $event = Event::with('users')->where('eventstatus','=', 'approved')->paginate(15);

//          parse to view
            return view('pages.event', compact('event'));
        }

//      redirect organization role
//      get the organization event
        elseif ($user->hasRole('organization'))
        {
//          get user ID from the authenticated user
            $id = Auth::id();
            $session = 'detail';

//          getting value of Event table and user table using Eloquent
            $event = Event::with('users')->where('userid', '=', $id)->paginate(15);

//          parse to view
            return view('pages.event', compact('event','session'));
        }

//      redirect user admin, get un-approved events only
        elseif ($user->hasRole('admin'))
        {

////          getting value of Event table and user table using Query Builder
//            $event = DB::table('users')
//                        ->join('events', 'userid', '=', 'users.id')
//                        ->select('users.name as organizer', 'events.*')
//                        ->where('eventstatus', 'pending')
//                        ->get();


//          getting value of Event table and user table using Eloquent
            $event = Event::with('users')->where('eventstatus','=', 'pending')->latest()->paginate(15);

//          parse result to view
            return view('pages.event', compact('event'));
        }

    }

//   create event form
    public function showCreateEventForm()
    {
        $interest = Interest::all();
        return view('pages.create_event_form', compact('interest'));
    }


//    create event function
    public function postEvent(Request $request)
    {

//      create event form validator
        $this -> validate($request,[
          'eventname' => 'required',
          'eventname' => 'required',
          'eventdate' => 'required',
          'editor1' => 'required',
          'province' => 'required',
          'city' => 'required',
          'district' => 'required',
          'address' => 'required',
          'interest' => 'interest_id'
        ]);

//      save event data
        $avatar = $request->file('avatar')->store('avatars');


        Event::create([
            'userid' => $request->userid,
            'eventname'=> $request->eventname,
            'eventdate' =>  $request->eventdate,
            'eventdetail' =>  $request->editor1,
            'eventstate' => $request->province,
            'eventcity'=>  $request->city,
            'eventdistrict' =>  $request->district,
            'eventaddress' =>  $request->address,
            'eventstatus' =>  'pending',
            'poster' =>  $avatar,
            'interest' =>  $request->interest_id,
        ]);

        return redirect()->back()->with('create_success','event creation success');
    }


    public function showEventDetail(Event $event)
    {
        $session = 'detail';
        return view('pages.event_detail', compact('event', 'session'));
    }

    public function eventApproval(Event $event, Request $request)
    {
//        get event organizer ID
        $userid = $event->userid;

//        get event organizer email address
        $email = User::where('id', $userid)->first();
        $data = $event->toArray();
        $data['email'] = $email['email'];
        $data['name'] = $email['name'];
        $data['approval'] = $request->approval;
        $data['reqreason'] = $request->reasons;
//        dd($data);

//      update event data from the route
        $event->update([
            'eventstatus'=>request('approval'),
            'reasons'=>request('reasons')
        ]);

        Mail::send('email.approval', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Email Request');
        });


        \Session::flash('event_approve', 'event approved' );
        return redirect()->route('admin.list.event');

    }

    public function eventForComment()
    {
        //          get user ID from the authenticated user
        $id = Auth::id();
        $session = 'comment';

//          getting value of Event table and user table using Eloquent
        $event = Event::with('users')->where('userid', '=', $id)->paginate(15);

//          parse to view
        return view('pages.event')->with(compact('event', 'session'));
    }

    public function eventForManage()
    {
        //          get user ID from the authenticated user
        $id = Auth::id();
        $session = 'volunteers';
//          getting value of Event table and user table using Eloquent
        $event = Event::with('users')->where('userid', '=', $id)->paginate(15);

//          parse to view
        return view('pages.event', compact('event','session'));
    }

    public function attendedEvent()
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->get();
//          get the user id
        $id = Auth::id();
//          get the registered event
        $session ='print';
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
        return view('pages.attended_event', compact( 'attended','user', 'session'));
    }

    public function search(Request $request)
    {
        $keyword = $request->search;

        $user = User::find(Auth::user()->id);
        if($user->hasRole('user'))
        {
            $event = Event::with('users')->SearchByKeyword($keyword)->where('eventstatus','approved')->latest()->paginate(15);
            return view('pages.event', compact('event'));
        }
        elseif($user->hasRole('admin'))
        {
            $event = Event::with('users')->SearchByKeyword($keyword)->latest()->paginate(15);
            return view('pages.event', compact('event'));
        }
        elseif($user->hasRole('organization'))
        {
            $session = 'detail';
            $id =Auth::user()->id;
            $event = Event::with('users')->SearchByKeyword($keyword)->where('userid','=',$id)->latest()->paginate(15);
            return view('pages.event', compact('event','session'));
        }
//        dd($request);

    }


    public function guestEvent()
    {
//        getting value of Event table and user table using Eloquent
            $event = Event::with('users')->where('eventstatus','=', 'approved')->paginate(15);

//          parse to view
            return view('pages.guest_event', compact('event'));
    }

    public function guestSearch(Request $request)
    {
        $keyword = $request->search;
        $event = Event::with('users')->SearchByKeyword($keyword)->where('eventstatus', 'approved')->latest()->paginate(15);
        return view('pages.event', compact('event'));
    }
}
