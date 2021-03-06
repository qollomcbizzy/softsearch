@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add A Company</div>

                <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                   
                <form id="companyform" method="post" action="{{ route('addcompany.post')}}" enctype="multipart/form-data">
                   @csrf
                    <div class="form-group">
                        <label>Name </label>
                        <input type="text" name="name" placeholder="please enter the company name" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Logo </label>
                        <input type="file" name="logo" class="form-control-file">
                        
                    </div>
                    <div class="form-group">
                        <label>Website </label>
                        <input type="url" name="website" placeholder="please enter the website link" class="form-control">
                    </div>
                    
                        <div class="form-row float-right">
                        <a href="{{ route('companies')}}" class="btn btn-secondary btn-sm mr-3">Back</a><button type="submit" class="btn btn-primary btn-sm">Add</button>
                        </div>
                 </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection