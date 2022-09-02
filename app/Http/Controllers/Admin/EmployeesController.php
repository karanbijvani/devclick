<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Company;

class EmployeesController extends Controller
{
    public function index() {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return view('admin.employees.list', compact('employees'));
    }

    public function create() {
        $companies = Company::all();
        return view('admin.employees.create', compact('companies'));
    }

    public function store(EmployeeRequest $request){
        $data = new Employee;
        $data->company_id = $request->company_id;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->save();
        return to_route('employees')->with('message', 'Employee Created Successfully!');
    }

    public function edit(Employee $employee) {
        $companies = Company::all();
        return view('admin.employees.edit', ['employee' => $employee], compact('companies'));
    }


    public function update(EmployeeRequest $request, Employee $employee){
        $data = Employee::findOrFail($employee->id);
        $data->company_id = $request->company_id;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->update();
        return to_route('employees')->with('message', 'Employee Updated Successfully!');
    }

    public function destroy(Employee $employee) {
        $employee->delete();
        return to_route('employees')->with('message','Employee deleted successfully!');;
    }
}

