@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   <div class="list-group">
                      <a href="{{ route('companies')}}" class="list-group-item">Companies</a>
                      <a href="{{ route('employees')}}" class="list-group-item">Employees</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
