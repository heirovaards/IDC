<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\Interest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\User_role;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{
    public function manageUser()
    {
        $user = User::with('roles')->get();
        $interests = Interest::all();
        return view('pages.manage_user', compact('user', 'interests'));
    }

    public function manageEvent()
    {
        $event = Event::with('users')->get();
        return view('pages.manage_event', compact('event'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function editUser(User $user)
    {
        $id = $user->id;
        $edituser = User::where('id','=', $id)->get();
        $interest = Interest::all();
        return view('pages.edit_user', compact('edituser', 'interest'));
    }

    public function updateUser(User $edituser, Request $request)
    {
      $id = $request->id;
      $user = User::where('id', $id);
      $oldavatar =  $request->oldavatar;


        if ($request->hasFile('avatar')) {
            Storage::delete($oldavatar);

            $avatar = $request->file('avatar')->store('avatars');
            $user->update([
                'name' => request('name'),
                'username' => request('username'),
                'email' => request('username'),
                'phone' => request('phone'),
                'interest' => request('interest_id'),
                'avatar' => $avatar
            ]);
        }

        else
        {
            $user->update([
                'name' => request('name'),
                'username' => request('username'),
                'email' => request('username'),
                'phone' => request('phone'),
                'interest' => request('interest_id')
            ]);
        }

        $user = User::find(Auth::user()->id);

        if ($user->hasRole('organization'))
        {
            return redirect()->route('organization');

        }
        elseif ($user->hasRole('user'))
        {
            return redirect()->route('user');
        }
        elseif ($user->hasRole('admin'))
        {
            return redirect()->route('manage.user');
        }



    }

    public function editEvent(Event $event)
    {
        $id = $event->id;
        $editevent = Event::where('id','=', $id)->get();

        $interest = Interest::all();

        return view('pages.edit_event', compact('editevent', 'interest'));
    }

    public function updateEvent(Event $event, Request $request)
    {
        $id = $request->id;
        $event = Event::where('id', $id);
        $oldavatar =  $request->oldavatar;
        if ($request->hasFile('poster')) {

            Storage::delete($oldavatar);
            $avatar = $request->file('poster')->store('avatars');
            $event->update([
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
        }

        else
        {

            $event->update([
                'eventname'=> $request->eventname,
                'eventdate' =>  $request->eventdate,
                'eventdetail' =>  $request->editor1,
                'eventstate' => $request->province,
                'eventcity'=>  $request->city,
                'eventdistrict' =>  $request->district,
                'eventaddress' =>  $request->address,
                'eventstatus' =>  'pending',
                'interest' =>  $request->interest_id,
            ]);
        }

        $user = User::find(Auth::user()->id);

        if ($user->hasRole('organization'))
        {
            return redirect()->route('org.list.event');

        }

        elseif ($user->hasRole('admin'))
        {
            return redirect()->route('manage.event');
        }


    }


    public function deleteEvent(Event $event)
    {
        $event->delete();
        return redirect()->back();
    }

    public function manageInterest()
    {
        $interest=Interest::all();
        return view('pages.manage_interest', compact('interest'));
    }

    public function addInterest(Request $request)
    {
        $this->validate($request, [
           'interest:unique'
        ]);

        Interest::create([
            'interest'=>$request->interest
        ]);
        return redirect()->back()->with('new_interest','new interest added');
    }

    public function deleteInterest(Interest $interest)
    {
        $interest->delete();
        return redirect()->back()->with('delete_interest','new interest added');
    }

}
