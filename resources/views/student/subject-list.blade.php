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
                     {{-- <div class="col-auto text-right float-right ml-auto">
                        
                        <a href="add-subject.html" class="btn btn-primary">Add Subject <i class="fas fa-plus"></i></a>
                     </div> --}}
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
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Class</th>
                                       <th class="text-right">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>PRE2209</td>
                                       <td>
                                          <h2>
                                             <a>Mathematics</a>
                                          </h2>
                                       </td>
                                       <td>5</td>
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="edit-subject.html" class="btn btn-sm bg-success-light mr-2">
                                             <i class="fas fa-pen"></i>
                                             </a>
                                             <a href="#" class="btn btn-sm bg-danger-light">
                                             <i class="fas fa-trash"></i>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>PRE2213</td>
                                       <td>
                                          <h2>
                                             <a>History</a>
                                          </h2>
                                       </td>
                                       <td>6</td>
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="edit-subject.html" class="btn btn-sm bg-success-light mr-2">
                                             <i class="fas fa-pen"></i>
                                             </a>
                                             <a href="#" class="btn btn-sm bg-danger-light">
                                             <i class="fas fa-trash"></i>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>PRE2143</td>
                                       <td>
                                          <h2>
                                             <a>Science</a>
                                          </h2>
                                       </td>
                                       <td>3</td>
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="edit-subject.html" class="btn btn-sm bg-success-light mr-2">
                                             <i class="fas fa-pen"></i>
                                             </a>
                                             <a href="#" class="btn btn-sm bg-danger-light">
                                             <i class="fas fa-trash"></i>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>PRE2431</td>
                                       <td>
                                          <h2>
                                             <a>Geography</a>
                                          </h2>
                                       </td>
                                       <td>8</td>
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="edit-subject.html" class="btn btn-sm bg-success-light mr-2">
                                             <i class="fas fa-pen"></i>
                                             </a>
                                             <a href="#" class="btn btn-sm bg-danger-light">
                                             <i class="fas fa-trash"></i>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>PRE1534</td>
                                       <td>
                                          <h2>
                                             <a>Botony</a>
                                          </h2>
                                       </td>
                                       <td>9</td>
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="edit-subject.html" class="btn btn-sm bg-success-light mr-2">
                                             <i class="fas fa-pen"></i>
                                             </a>
                                             <a href="#" class="btn btn-sm bg-danger-light">
                                             <i class="fas fa-trash"></i>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>PRE2153</td>
                                       <td>
                                          <h2>
                                             <a>English</a>
                                          </h2>
                                       </td>
                                       <td>4</td>
                                       <td class="text-right">
                                          <div class="actions">
                                             <a href="edit-subject.html" class="btn btn-sm bg-success-light mr-2">
                                             <i class="fas fa-pen"></i>
                                             </a>
                                             <a href="#" class="btn btn-sm bg-danger-light">
                                             <i class="fas fa-trash"></i>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
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