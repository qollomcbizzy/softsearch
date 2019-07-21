@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>

                <div class="card-body">
               <a href="{{ route('addcompany')}}" class="mdi mdi-plus  float-right btn btn-primary mb-3"></a>
                   <table id="companiestable"class="table table-striped">
                      <thead>
                            <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>LOGO </th>
                            <th>Website</th>
                            <th></th>
                            </tr>
                      </thead>
                      <tbody>
                         @foreach($companies as $company)
                         <tr>
                           <th>{{$i++}}</th>
                           <th>{{$company->name}}</th>
                           <th><img class="img-responsive" src="{{  url('storage/uploads/logos/'.$company->logo)}}" height="120" width="120"></th>
                           <th><a href="{{$company->website}}">{{$company->website}}</a></th>
                           <th><a href="{{ url('/company/view',$company->company_id)}}" class="btn btn-primary mr-2">View</a><a href="{{ url('/company/edit',$company->company_id)}}" class="btn btn-primary mr-2">Edit</a><a href="{{ route('company.delete',$company->company_id)}}" class="btn btn-danger">Delete</a></th>
                         </tr>
                         @endforeach
                      </tbody>
                   </table>
                </div>
                <div class="card-footer">
                <a href="{{ route('home')}}" class="btn btn-secondary btn-sm float-right">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#companiestable").DataTable();
})
</script>
@endsection