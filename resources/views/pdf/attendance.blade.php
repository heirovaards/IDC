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
        <div>Attendance for <h2>{{$event->eventname}}</h2></div>
       <table id="example2" role="grid">
            <thead>
              <tr role="row">
                <th width="20%">Registration ID</th>
                <th width="20%">Name</th>
                <th width="20%">Status</th>
                <th width="10%">Regritation Date</th>
                <th width="15%">Signature</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $data)
                <tr role="row" class="odd">
                    <td class=" ">{{$data->id}}</td>
                    <td class=" ">{{$data->users->name}}</td>
                    <td class=" ">{{$data->status}}</td>
                    <td class=" ">{{$data->created_at}}</td>
                    <td></td>
              </tr>
            @endforeach
            </tbody>
          </table>
    </div>
  </body>
</html>