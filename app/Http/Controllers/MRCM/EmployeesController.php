<?php

namespace App\Http\Controllers\MRCM;

use App\Employee;
use App\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 1;
        $employees = Employee::all();
       return view('mrcm.employees',compact('employees'))->with(['i'=>$i]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('mrcm.addemployee',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createdby = Auth::User()->email;

       $employee = new Employee;
       $employee->firstname = $request->fname;
       $employee->lastname = $request->lname;
       $employee->email = $request->email;
       $employee->phoneno = $request->phoneno;
       $employee->company_id = $request->company;
       $employee->created_by = $createdby;

       $employee->save();

       return response()->json("success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = DB::table('employees')
                         ->join('companies','companies.company_id','=','employees.company_id')
                         ->where('employee_id','=',$id)
                         ->select('companies.*','employees.*')
                         ->get();
        return view('mrcm.viewemployee')->with(['employee'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = DB::table('employees')
                        //  ->join('companies','companies.company_id','=','employees.company_id')
                         ->where('employee_id','=',$id)->first();
        $companyid = $employee->company_id;
        $ecompany = DB::table('companies')->where('company_id','=',$companyid)->get();
        $companies = DB::table('companies')->get(); 

        return view('mrcm.editemployee',compact('employee'))->with(['companies'=>$companies])->with(['ecompany'=>$ecompany]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $updatedby = Auth::User()->email;
        $firstname = $request->fname;
        $lastname = $request->lname;
        $email = $request->email;
        $phoneno = $request->phoneno;
        $company_id = $request->company;

        DB::update('update employees set firstname = ?,lastname = ?,email= ?,phoneno = ?,company_id=?,updated_by =? where employee_id = ?',[$firstname,$lastname,$email,$phoneno,$company_id,$updatedby,$id]);
        return response()->json('Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('employees')->where('employee_id','=',$id)->delete(); 

        return redirect()->action('MRCM\EmployeesController@index');
    }
}
