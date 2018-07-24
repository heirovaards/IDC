<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Event;
use App\User;
use Dompdf\Dompdf;


class ReportController extends Controller
{
    public function printPDF(Request $request)
    {
        $id = $request->userid;
        $data = Registration::with('events')->where('userid', $id)->get();
        $pdf = PDF::loadView('pdf.pdf', compact('data'));
        return $pdf->download('Attended_event');
    }

    public function printCertificate(Request $request)
    {
//        dd($request);
        $pdf = new Dompdf();
        $id = $request->userid;
        $user = Auth::user()->name;
        $event = Event::where('id', $request->eventid)->get();

        $pdf = PDF::loadView('pdf.certificate', compact( 'user', 'event'));
        $pdf->setPaper('A4','landscape');
        return $pdf->download('certificate');
    }

    public function printAttendance(Request $request, Event $event)
    {
        $eventid = $event->id;
        $data = Registration::with('users')->where('eventid', '=', $eventid)->get();


        $pdf = PDF::loadView('pdf.attendance', compact('data', 'event'));
        return $pdf->download('Attended_event');
    }

}
