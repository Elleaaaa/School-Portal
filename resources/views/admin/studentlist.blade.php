<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>All Students</title>
      <link rel="shortcut icon" href="assets/img/favicon.png">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
      <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      
   </head>
   <body>
      <div class="main-wrapper">
        @include('layouts/mainlayout')
         <div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Students</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Students</li>
                        </ul>
                     </div>
                     <div class="col-auto text-right float-right ml-auto">
                        
                        <a href="add-student.html" class="btn btn-primary">add Student  &nbsp;<i class="fas fa-plus"></i></a>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card card-table">
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-hover table-center mb-0 datatable">
                                 <thead>
                                    <tr>
                                       <th>Student ID</th>
                                       <th>Name</th>
                                       <th>Age</th>
                                       <th>DOB</th>
                                       <th>Religion</th>
                                       <th>Mobile Number</th>
                                       <th class="text-right">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($students as $student)
                                    <tr>
                                       <td>{{$paddedTeacherId = str_pad($student->studentId, 4, '0', STR_PAD_LEFT)}}</td>
                                       <td>
                                          <h2 class="table-avatar">
                                             <a href="student-details.html" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('img/profiles/avatar-01.jpg') }}"
                                                alt="User Image"></a>
                                             <a href="student-details.html">{{ $student->firstName }}</a>
                                          </h2>
                                       </td>
                                       <td>{{ $student->age }}</td>
                                       <td>{{ $student->birthday }}</td>
                                       <td>{{ $student->religion }}</td>
                                       <td>{{ $student->mobileNumber }}</td>
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="{{ route('edit-student.show', ['id' => $student->id]) }}" class="btn btn-sm bg-success-light mr-2">
                                             <i class="fas fa-pen"></i>
                                             </a>
                                             <a href="#" class="btn btn-sm bg-danger-light">
                                             <i class="fas fa-trash"></i>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @include('layouts/footer')
         </div>
      </div>
      
      <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
      
      <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "pageLength": 10
            });
        });
    </script>
    


   </body>
   
</html>