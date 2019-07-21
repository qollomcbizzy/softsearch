@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee Profile</div>

                <div class="card-body">
                 <div class="list-group-flush">
                 @foreach($employee as $employee)
                 <p class="list-group-item">First Name : <strong>{{$employee->firstname}}</strong></p>
                 <p class="list-group-item">Last Name : <strong>{{$employee->lastname}}</strong></p>
                 <p class="list-group-item">Company  Name : <strong>{{$employee->name}}</strong></p>
                 <p class="list-group-item">Email : <strong>{{$employee->email}}</strong></p>
                 <p class="list-group-item">Phone Number : <strong>{{$employee->phoneno}}</strong></p>
                 @endforeach
                 </div>
                </div>
                <div class="card-footer">
                <a href="{{ route('home')}}" class="btn btn-secondary btn-sm float-right">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection