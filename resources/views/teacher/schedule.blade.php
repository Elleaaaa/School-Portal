<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">

</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Calendar</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Calendar</li>
                        </ul>
                     </div>
                     
                     <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="150">Time</th>
                                    @foreach($weekDays as $day)
                                        <th>{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($calendarData as $timeText => $timeData)
                                    <tr>
                                        <td>{{ $timeText }}</td>
                                        @foreach($timeData as $value)
                                            @if(is_array($value))
                                                <td class="align-middle text-center" style="background-color:#f0f0f0" rowspan="{{ $value['rowspan'] }}">
                                                    {{ $value['class_name'] }}<br>
                                                    (ROOM {{ $value['room'] }})
                                                </td>
                                            @elseif($value === 1)
                                                <td></td>
                                            @else
                                                <td class="blocked-cell"></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    

                  </div>
               </div>

            </div>
            
            @include('layouts/footer')
        </div>
    </div>
</body>

</html>