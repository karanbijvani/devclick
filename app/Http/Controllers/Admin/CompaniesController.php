<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\File;

class CompaniesController extends Controller
{
    public function index() {
        $companies = Company::orderBy('id', 'desc')->paginate(10);
        return view('admin.companies.list', compact('companies'));
    }

    public function create() {
        return view('admin.companies.create');
    }

    public function store(CompanyRequest $request){
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
        \Mail::to($data->email)->send(new \App\Mail\CompanyMail($data));
        return to_route('companies')->with('message', 'Company Created Successfully!');
    }

    public function edit(Company $company) {
        return view('admin.companies.edit', ['company' => $company]);
    }

    public function update(CompanyRequest $request, Company $company) {
        $data = Company::findOrFail($company->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->website = $request->website;
        
        if($request->hasFile('logo')){
            // Remove Image
            $old_file = 'storage/'.$data->logo;
            if(File::exists($old_file)) {
                File::delete($old_file);
            }
            $file = $request->file('logo');
            $filename = time(). '-' .$file->getClientOriginalName();
            $file->storeAs('public',$filename);
            $data->logo = $filename;
        }
        
        $data->update();
        return to_route('companies')->with('message','Company Updated Successfully!');
    }

    public function destroy(Company $company) {
        $old_file = 'storage/'.$company->logo;
        if(File::exists($old_file)) {
            File::delete($old_file);
        }
        $company->delete();
        return to_route('companies')->with('message','Company deleted successfully!');;
    }
}
