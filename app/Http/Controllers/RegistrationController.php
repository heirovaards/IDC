<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function eventRegistration(Event $event)
    {


        $eventid = $event->id;
        $userid = Auth::id();


        $registration = Registration::where([
            ['userid', '=', $userid],
            ['eventid', '=', $eventid]
        ])->count();

        if ($registration > 0)
        {
            return redirect()->back()->with('registration_fail', 'You have been registered to this event');
        }

        else
        {
            Registration::create([
                'userid' => $userid,
                'eventid' => $eventid,
                'status' => 'registered'
            ]);

            return redirect()->back()->with('registration_success', 'Your Registration has been recorded');
        }
    }

    public function manageVolunteer (Event $event)
    {
        $eventid = $event->id;
        $user = Registration::with('users')->where('eventid', '=', $eventid)->get();

        return view('pages.manage_volunteer', compact('user', 'event'));
    }

    public function attendEvent(Request $request)
    {
//      get attendance from Registration ID
//      $id retrieved as Array
        $id = $request->id;

//       for each value in $id value are updated
        foreach ($id as $id)
        {
//            update function, massive update can only be done using query
            DB::table('registrations')
                ->where('id', $id)
                ->update(['status'=> 'attended']);
        }

//      return redirect back to previous page
        return redirect()->back();
    }

}
