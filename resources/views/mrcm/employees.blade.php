@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employees</div>

                <div class="card-body">
                <a href="{{ route('addemployee')}}" class="mdi mdi-plus  float-right btn btn-primary mb-3"></a>
                   <table id="employeestable"class="table table-striped">
                      <thead>
                            <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th></th>
                            </tr>
                      </thead>
                      <tbody>
                      <tbody>
                         @foreach($employees as $employee)
                         <tr>
                           <th>{{$i++}}</th>
                           <th>{{$employee->firstname}}</th>
                           <th>{{$employee->lastname}}</th>
                           <th>{{$employee->email}}</th>
                           <th>{{$employee->phoneno}}</th>
                           <th><a href="{{ route('employee.view',$employee->employee_id)}}" class="btn btn-primary mr-2">View</a><a href="{{ route('employee.edit',$employee->employee_id)}}" class="btn btn-primary mr-2">Edit</a><a href="{{ route('employee.delete',$employee->employee_id)}}" class="btn btn-danger">Delete</a></th>
                         </tr>
                         @endforeach
                      </tbody>
                      </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection