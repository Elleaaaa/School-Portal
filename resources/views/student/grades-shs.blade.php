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
                        <h3 class="page-title">Grades</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Grades</li>
                        </ul>
                     </div>
                    </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                      <div class="card card-table">
                          <div class="card-body">
                              <div class="col-12 col-sm-3">
                                  <div class="form-group">
                                      <select class="form-control" id="schoolYear" name="schoolYear" required>
                                          <option value="">School Year</option>
                                          @foreach($schoolYears as $schoolYear)
                                              <option value="{{ $schoolYear }}">{{ $schoolYear }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                              <div class="table-responsive">
                                  <table class="table table-hover table-center mb-0 datatable">
                                      <thead>
                                          <tr>
                                              <th>Subject</th>
                                              <th>Midterm</th>
                                              <th>Finals</th>
                                          </tr>
                                      </thead>
                                      <tbody id="gradesTableBody">
                                          <tr>
                                            {{-- grades will be load here --}}
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
         document.getElementById('schoolYear').addEventListener('change', function() {
             var schoolYear = this.value;
             if (schoolYear) {
                 fetch(`/get-shs-grades?schoolYear=${schoolYear}`)
                     .then(response => response.json())
                     .then(data => {
                         var gradesTableBody = document.getElementById('gradesTableBody');
                         gradesTableBody.innerHTML = ''; // Clear existing grades
     
                         data.forEach(function(grade) {
                             var row = document.createElement('tr');
                             row.innerHTML = `
                                 <td>${grade.subject}</td>
                                 <td>${grade.midterm}</td>
                                 <td>${grade.finals}</td>
                             `;
                             gradesTableBody.appendChild(row);
                         });
                     })
                     .catch(error => {
                         console.error('Error fetching grades:', error);
                     });
             }
         });
     </script>
   </body>
   </html>