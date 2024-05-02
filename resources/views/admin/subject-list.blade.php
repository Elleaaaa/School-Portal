<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>Smartious - Subjects</title>
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
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Subjects</li>
                        </ul>
                     </div>
                     <div class="col-auto text-right float-right ml-auto">
                        
                        <a href="{{ route('addsubject.show') }}" class="btn btn-primary">Add Subject <i class="fas fa-plus"></i></a>
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
                                       <th>Grade <br>Level</th>
                                       <th>Subject <br>Code</th>
                                       <th>Subject Title </th>
                                       <th>Type</th>
                                       <th>Teacher</th>
                                       {{-- <th>Units</th>
                                       <th>Lecture <br>Unit</th>
                                       <th>Laboratory <br>Unit</th> --}}
                                       <th class="text-right">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($subjects as $subject)
                                    <tr>
                                       <td>{{$subject->gradeLevel}}</td>
                                       <td>{{$subject->subjectCode}}</td>
                                       <td>{{$subject->subjectTitle}}
                                       <td>{{$subject->subjectType}}</td>
                                       <td>{{$subject->subjectTeacher}}</td>
                                       {{-- <td>{{$subject->subjectUnit}}</td>
                                       <td>{{$subject->subjectLectUnit}}</td>
                                       <td>{{$subject->subjectLabUnit}}</td> --}}
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="{{ route('edit-subject.show', ['id' => $subject->id]) }}" class="btn btn-sm bg-success-light mr-2">
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