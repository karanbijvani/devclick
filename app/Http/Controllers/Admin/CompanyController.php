<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() :object
    {
        $companies = Company::query()->orderBy('id', 'desc')->paginate(10);
        return view('admin.companies.list', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = new Company;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->website = $request->website;
        
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $filename = time(). '-' .$file->getClientOriginalName();
            $file->storeAs('public',$filename);
            $data->logo = $filename;
        }    
        $data->save();
        Mail::to($data->email)->send(new \App\Mail\CompanyMail($data));
        return to_route('companies')->with('message', 'Company Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   object $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company) :object
    {
        return view('admin.companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CompanyRequest  $request
     * @param  object $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company) :object
    {
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        
        if($request->hasFile('logo')){
            // Remove Image
            $old_file = 'storage/'.$company->logo;
            if(File::exists($old_file)) {
                File::delete($old_file);
            }
            $file = $request->file('logo');
            $filename = time(). '-' .$file->getClientOriginalName();
            $file->storeAs('public',$filename);
            $company->logo = $filename;
        }
        
        $company->update();
        return to_route('companies')->with('message','Company Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   object $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company) :object
    {
        $old_file = 'storage/'.$company->logo;
        if(File::exists($old_file)) {
            File::delete($old_file);
        }
        $company->delete();
        return to_route('companies')->with('message','Company deleted successfully!');
    }
}
