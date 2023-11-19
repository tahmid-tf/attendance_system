<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::orderBy('id','desc')->get();

        return view("admin.admin-content.employee.view", compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view("admin.admin-content.employee.edit", compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Employee $employee)
    {

        $inputs = \request()->validate([
            'name' => 'required',
            'designation' => 'required',
            'status' => 'required',
        ]);

        $employee->update($inputs);

        session()->flash('success', 'Employee Data Updated Successfully');
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Employee $employee)
    {

        $attendance_removal = Attendance::where('employee_token_id', $employee->employee_token_id)->get();

        if ($attendance_removal->count() != 0) {
            // If $attendance_removal exists, delete its data
            $attendance_removal->each(function ($attendance) {
                $attendance->delete();
            });
        }

        $employee->delete();
        session()->flash('success', 'Employee Data Deleted Successfully');
        return redirect()->route('employee.index');
    }
}
