 <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }
      td, th {
        border: solid 2px;
        padding: 10px 5px;
      }
      tr {
        text-align: center;
      }
      .container {
        width: 100%;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
        <div><h2>List of Attended Event {{ Auth::user()->name}}</h2></div>
       <table id="example2" role="grid">
            <thead>
              <tr role="row">
                <th width="20%">Event Name</th>
                <th width="20%">Event Date</th>
                <th width="10%">Event Address</th>
                <th width="10%">Status</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $data)
                <tr role="row" class="odd">
                    <td class=" ">{{$data->events->eventname}}</td>
                    <td>{{date('d F, Y', strtotime($data->events->eventdate))}}</td>
                    <td class=" ">{{$data->events->eventaddress}}, {{$data->events->eventdistrict}}, {{$data->events->eventcity}}, {{$data->events->eventstate}}</td>
                    <td class=" ">{{$data->status}}</td>
                    <td></td>
              </tr>
            @endforeach
            </tbody>
          </table>
    </div>
  </body>
</html>