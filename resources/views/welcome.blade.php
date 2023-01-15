<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Ajax CRUD</title>

    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        input[type=text],[type=email],[type=number],[type=password]{
            box-shadow: none !important;
            border-top:0;
            border-left:0;
            border-right:0;
        }
    </style>
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                            Add Employee
                        </a>
                        @if(session("success_msg"))
                            <span class="text-success">{{session("success_msg")}}</span>
                        @endif
                        @if(session("error_msg"))
                            <span class="text-danger">{{session("error_msg")}}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div>
                            @if($employees->count()>0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr id="table_row_{{$employee->id}}">
                                            <td>{{$employee->firstname}}</td>
                                            <td>{{$employee->lastname}}</td>
                                            <td>{{$employee->email}}</td>
                                            <td>{{$employee->phone}}</td>
                                            <td>
                                                <a href="#" id="editEmployee" data-id={{$employee->id}} data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <a href="#" id="deleteEmployee" data-id={{$employee->id}} class="ms-3">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5">
                    Register Employee
                    <div class="text-danger print-error-msg fs-6" style="display: none">
                        <ul></ul>
                    </div>
                </h1>
                
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearData()"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="addUpdate(event)" id="addUpdateForm" autocomplete="off">
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="firstname@example.com" required>
                                <label for="firstname">First Name</label> 
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="lastname@example.com" required>
                                <label for="lastname">Last Name</label>
                            </div>
                        </div>
    
                        <div class="col-md-12">
                            <div class="form-floating mb-2">
                                <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com" required>
                                <label for="email">Email</label>
                                
                            </div>
                        </div>
    
                        <div class="col-md-12">
                            <div class="form-floating mb-2">
                                <input type="number" name="phone" class="form-control" id="phone" placeholder="phone@example.com" required>
                                <label for="phone">Phone</label>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-floating mb-2">
                                <input type="password" name="password" class="form-control" id="password" placeholder="pasword@example.com" required>
                                <label for="password">Password</label>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="employeeId" id="employeeId">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
          </div>
        </div>
    </div>

<script src="{{asset('assets/js/employees.js')}}"></script> 
</body>
</html>