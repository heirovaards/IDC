 <!DOCTYPE html>
 <html lang="en">
 <div style="width:980px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
     <div style="width:930px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">
         <span style="font-size:70px; font-weight:bold">Certificate of Completion</span>
         <br><br>
         <span style="font-size:45px"><i>This is to certify that</i></span>
         <br><br>
         <span style="font-size:50px"><b>{{$user}}</b></span><br/><br/>
         @foreach($event as $event)
         <span style="font-size:45px"><i>has completed the Event</i></span> <br/><br/>
         <span style="font-size:50px">{{$event->eventname}}</span> <br/><br/>
         <span style="font-size:45px"><i>dated</i></span><br>
             <span style="font-size:50px"> {{date('d F, Y', strtotime($event->eventdate))}}</span>
         @endforeach
     </div>
 </div>
 </html>