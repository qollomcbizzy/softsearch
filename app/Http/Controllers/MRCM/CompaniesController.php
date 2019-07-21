<?php

namespace App\Http\Controllers\MRCM;

use App\Company;
use Image;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $i = 1;
        return view('mrcm.companies',compact('companies'))->with(['i'=>$i]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mrcm.addcompany');
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
        $this->validate($request,[
            'name'=>'required',
            'logo'=>'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website'=>'required'
       ]);
        $company = new Company;
        $company->name = $request->name;
        $company->website = $request->website;
        $company->created_by = $createdby;
       if($request->hasFile('logo')){
           $image = $request->file('logo');
           $filename = time().'.'.$image->getClientOriginalExtension();
        //    save(storage_path('uploads/logos/'.$filename));
           $image->move(storage_path('app/public/uploads/logos'),$filename);
           $company->logo=$filename;
           $company->save();
       }
       $company->save();

       $data = [];

       Mail::send('emails.notification',$data, function ($message) {
         $message->from('admin@admin.com', 'Mini-CRM');
    
         $message->to('kiprotichcollinsengineer1@gmail.com')->subject("Notification");
       });

       return redirect()->action('MRCM\CompaniesController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = DB::table('companies')->where('company_id','=',$id)->first();
        
        $employees = DB::table('employees')->where('company_id','=',$id)->get();

        $noemployee = $employees->count();

        return view('mrcm.viewcompany',compact('company'))->with(['noemployee'=>$noemployee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = DB::table('companies')->where('company_id','=',$id)->first(); 

        return view('mrcm.editcompany',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)

    {
        $this->validate($request,[
            'name'=>'required',
            'logo'=>'image|mimes:jpeg,png,jpg,svg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website'=>'required'
       ]);
       $createdby = Auth::User()->email;
        // $company = $company = DB::table('companies')->where('company_id','=',$id)->first(); 
        $name = $request->name;
        $website = $request->website;
      
       if($request->hasFile('logo')){
           $image = $request->file('logo');
           $filename = time().'.'.$image->getClientOriginalExtension();
        //    save(storage_path('uploads/logos/'.$filename));
           $image->move(storage_path('app/public/uploads/logos'),$filename);
           DB::update('update companies set logo = ? where company_id = ?',[$filename,$id]);
       }
       DB::update('update companies set name = ?,website = ? where company_id = ?',[$name,$website,$id]);
       return redirect()->action('MRCM\CompaniesController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     DB::table('companies')->where('company_id','=',$id)->delete(); 

      return redirect()->action('MRCM\CompaniesController@index');
    }
}
