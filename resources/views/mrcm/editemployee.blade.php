@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit an  employee</div>

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
                
                <form id="employeeform">
                   @csrf
                    <div class="form-group">
                        <label>First Name </label>
                        <input type="text" name="fname" value="{{$employee->firstname}}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Last Name </label>
                        <input type="text" name="lname" value="{{$employee->lastname}}" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Company </label>
                        <select name="company" class="form-control" >
                          @foreach($ecompany as $ecompany)
                          <option value="{{$ecompany->company_id}}">{{$ecompany->name}}</option>
                          @endforeach
                           @foreach($companies as $company)
                           <option value="{{$company->company_id}}">{{$company->name}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email </label>
                        <input type="email" name="email" value="{{$employee->email}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Phone Number </label>
                        <input type="number" name="phoneno" value="{{$employee->phoneno}}" class="form-control">
                    </div>
                    
                        <div class="form-row float-right">
                        <a href="{{ route('employees')}}" class="btn btn-secondary btn-sm mr-2">Back</a><button type="submit" class="btn btn-primary btn-sm">Add</button>
                        </div>
                 </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 $(document).ready(function(){
     $("#employeeform").submit(function (e) { 
         e.preventDefault();
         $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
         var fname = $("input[name='fname']").val();
         var lname = $("input[name='lname']").val();
         var company = $("select[name='company']").val();
         var email = $("input[name='email']").val();
         var phoneno = $("input[name='phoneno']").val();
         
         if( fname === '' | lname === '' || company === '' || email === '' || phoneno === ''){
             alert("Please fill all the fields");
         }
         else
         {
             $.ajax({
                 type: "post",
                 url: "/employee/<?php echo $employee->employee_id;?>/update",
                 data: {fname:fname,lname:lname,company:company,email:email,phoneno:phoneno},
                 dataType: "json",
             })
             .done(function(data){
                alert(data);
                window.location.href="<?php echo route('employees');?>";
              })
              .fail(function(jqXHR, textStatus){
              alert('Error occurred: ' + textStatus);
              });
         }
     });
 })
</script>
@endsection