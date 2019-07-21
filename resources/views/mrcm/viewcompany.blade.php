@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company Profile</div>

                <div class="card-body">
                 <div class="list-group-flush">
                 
                 <p class="list-group-item"> <img src="{{  url('storage/uploads/logos/'.$company->logo)}}" height="200" width="600"></p>
                 <p class="list-group-item">Company Name : <strong>{{$company->name}}</strong></p>
                 <p class="list-group-item">Company  Website : <strong>{{$company->website}}</strong></p>
                 <p class="list-group-item">No of Employees : <strong>{{$noemployee}}</strong></p>
                
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