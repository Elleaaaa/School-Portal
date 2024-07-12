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
                        <h3 class="page-title">Section</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Sections</li>
                        </ul>
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
                                       <th>Grade Level</th>
                                       <th>Section</th>
                                       <th>Section Name</th>
                                       <th>Adviser</th>
                                       <th>Status</th>
                                       <th class="text-right">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($sections as $section)
                                    <tr>
                                       <td>{{ $section->gradeLevel }}</td>
                                       <td>{{ $section->section }}</td>
                                       <td>{{ $section->sectionName }}</td>
                                       <td>
                                        @foreach ($teachers as $teacher)
                                            @if ($teacher->teacherId === $section->teacherId)
                                                {{ $teacher->firstName }} {{ $teacher->lastName }}
                                            @endif
                                        @endforeach
                                        </td>
                                       <td>{{ $section->status }}</td>
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="{{ route('edit-section.show', ['id' => $section->id]) }}" class="btn btn-sm bg-success-light mr-2">
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