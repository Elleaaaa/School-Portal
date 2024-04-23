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

      <style>
         .btn.rounded-circle {
             border-radius: 50%;
             width: 25px; /* Adjust size as needed */
             height: 25px; /* Adjust size as needed */
             display: flex;
             justify-content: center;
             align-items: center;
             border: 3px solid black;
         }
     </style>
     
      
   </head>
   <body>
      <div class="main-wrapper">
        @include('layouts/mainlayout')
         <div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        @if (session('success'))
                            <div class="alert alert-success" id="successAlert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h3 class="page-title">Payments</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Payment List</li>
                        </ul>
                     </div>
                     <div class="col-auto text-right float-right ml-auto">
                        
                        <a class="btn btn-primary" data-toggle="modal" data-target="#addFeesModal">Add Payment <i class="fas fa-plus"></i></a>
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
                                       <th>ID</th>
                                       <th>Fee Type</th>
                                       <th>Amount</th>
                                       <th>Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($feeLists as $feeList)
                                    <tr>
                                       <td>{{$feeList->id}}</td>
                                       <td>{{$feeList->feeName}}</td>
                                       <td>{{$feeList->amount}}</td>
                                       <td>
                                          <div class="actions">
                                             <a class="btn btn-sm rounded-circle bg-{{ $feeList->status == 'active' ? 'success' : 'danger' }}"
                                                onclick="toggleStatus('{{ $feeList->id }}', '{{ $feeList->status }}')"
                                                id="statusButton{{ $feeList->id }}">
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

     <!-- Add FeeList Modal -->
    <div class="modal fade" id="addFeesModal" tabindex="-1" aria-labelledby="addFeesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFeesModalLabel">Add Fee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding event details -->
                    <form method="POST" action="{{route('addfeelist.store')}}" id="addEventForm">
                        @csrf
                        <div class="mb-3">
                            <label for="eventname" class="form-label">Fee Name</label>
                            <input type="text" class="form-control" id="feeName" name="feeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <!-- Add more fields as needed -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      
      <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
      
      <script>
        //for displaying datatable  
        $(document).ready(function() {
            $('.datatable').DataTable({
                "pageLength": 10
            });
        });

       
        // Close the alert after 3 seconds
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000);

        function toggleStatus(id, currentStatus) {
        // Send an AJAX request to update the status
        fetch(`/toggle-status/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: currentStatus })
        })
        .then(response => response.json())
        .then(data => {
            // Update the button color and text based on the new status
            const button = document.getElementById(`statusButton${id}`);
            if (data.status === 'active') {
                button.classList.remove('bg-danger');
                button.classList.add('bg-success');
                button.textContent = '';
            } else {
                button.classList.remove('bg-success');
                button.classList.add('bg-danger');
                button.textContent = '';
            }
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
    


   </body>
   
</html>