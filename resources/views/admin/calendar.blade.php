<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="icon" href="{{ asset('images/icons/baylogo.png') }}">
    <title>Schedule</title>

</head>

<body>
    <div class="main-wrapper">
        @include('layouts/mainlayout')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Schedule</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Schedule</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form method="GET" action="{{ route('calendar.get') }}" id="filterForm">
                            @csrf
                            <div class="form-row">
                                <div class="col-12 col-sm-2">
                                    <div class="form-group">
                                        <h2>Filter by:</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="gradeLevel">Grade Level</label>
                                        <select class="form-control" id="gradeLevel" name="gradeLevel" required>
                                            <option value=""></option>
                                            <option value="Grade 7">Grade 7</option>
                                            <option value="Grade 8">Grade 8</option>
                                            <option value="Grade 9">Grade 9</option>
                                            <option value="Grade 10">Grade 10</option>
                                            <option value="Grade 11">Grade 11</option>
                                            <option value="Grade 12">Grade 12</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <select class="form-control" id="section" name="section" required onchange="submitForm()">
                                            {{-- Section options will be populated dynamically --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th width="150">Time</th>
                            @foreach ($weekDays as $day)
                                <th>{{ $day }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach ($calendarData as $time => $days)
                                <tr>
                                    <td>
                                        {{ $time }}
                                    </td>
                                    @foreach ($days as $value)
                                        @if (is_array($value))
                                            <td rowspan="{{ $value['rowspan'] }}" class="align-middle text-center"
                                                style="background-color:#f0f0f0">
                                                {{ $value['class_name'] }}<br>
                                                {{ $value['teacher_name'] }}<br>
                                                (ROOM {{ $value['room'] }})
                                            </td>
                                        @elseif ($value === 1)
                                            <td></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            @include('layouts/footer')
        </div>
    </div>
     {{-- FETCH SECTION BASED ON GRADE LEVEL --}}
     <script src="{{ asset('js/myjs/fetchSection.js') }}"></script>

    <script>
        function submitForm() {
            document.getElementById('filterForm').submit();
        }
    </script>
</body>

</html>
