<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Device;

class EmployeeRegistrationController extends Controller
{

    public function modeOutput(Request $request)
    {


        $device = Device::where('device_token', request('device_id'))->first();

        if (!$device) {
            $response = [
                'success' => false,
                'message' => 'Device not found.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

        return response()->json([
            'mode' => $device->device_status
        ], 200); // Adjust the status code as needed

    }

    public function employee_registration(Request $request)
    {

//        $employee_token_id = $request->get('employee_token_id');
        $device_id = $request->get('device_id');
        $APP_KEY = $request->get('APP_KEY');


//  ---------------------------- Validation Checking ----------------------------

//        // Check if $employee_token_id is not an integer
//        if (!is_numeric($employee_token_id) || !is_int($employee_token_id + 0)) {
//            $response = [
//                'success' => false,
//                'message' => 'employee_token_id should be an integer.'
//            ];
//
//            return response()->json($response, 200);
//        }
//
//
//        if (empty($employee_token_id) || empty($device_id)) {
//            $response = [
//                'success' => false,
//                'message' => 'Both employee_token_id and device_id are required.'
//            ];
//            return response()->json($response, 200);
//        }

//  ---------------------------- Validation Checking ----------------------------


        // Typecast $employee_token_id to an integer


        $id = 0;

        if (Employee::orderBy('id', 'desc')->count() == 0) {
            $id = 1;
        } else if (!Employee::orderBy('id', 'desc')->count() == 0) {
            $id = Employee::orderBy('id', 'desc')->first()->id + 1;
        }


        $employee_token_id = $id;


//  ---------------------------- Device Checking ----------------------------

        $device = Device::where('device_token', $device_id)->first();

        if (!$device) {
            $response = [
                'success' => false,
                'message' => 'Device not found.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

        if ($device->device_status != "mode0") {
            $response = [
                'success' => true,
                'message' => 'Device is currently on attendance mode.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

//  ---------------------------- Device Checking ----------------------------

//  ---------------------------- Employee Checking ----------------------------

        $employee_info = Employee::where('employee_token_id', $employee_token_id)->where('device_id', $device->id)->count();


        if ($employee_info != 0) {
            $response = [
                'success' => false,
                'message' => 'Employee ID Already Exists'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

//  ---------------------------- Employee Checking ----------------------------

        $employee_add = Employee::create([
            'employee_token_id' => $employee_token_id,
            'device_id' => $device->id
        ]);

        if ($employee_add) {
            $response = [
                'success' => true,
                'message' => 'Employee ID Added Successfully',
                'employee_token_id' => $employee_add->employee_token_id
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

        return null;
    }


    public function employee_removal(Request $request)
    {

        $employee_token_id = $request->get('employee_token_id');
        $device_id = $request->get('device_id');


//  ---------------------------- Validation Checking ----------------------------

        // Check if $employee_token_id is not an integer
        if (!is_numeric($employee_token_id) || !is_int($employee_token_id + 0)) {
            $response = [
                'success' => false,
                'message' => 'employee_token_id should be an integer.'
            ];

            return response()->json($response, 400);
        }


        if (empty($employee_token_id) || empty($device_id)) {
            $response = [
                'success' => false,
                'message' => 'Both employee_token_id and device_id are required.'
            ];
            return response()->json($response, 200);
        }

//  ---------------------------- Validation Checking ----------------------------


        // Typecast $employee_token_id to an integer
        $employee_token_id = (int)$employee_token_id;

        //  ---------------------------- Device Checking ----------------------------

        $device = Device::where('device_token', $device_id)->first();

        if (!$device) {
            $response = [
                'success' => false,
                'message' => 'Device not found.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

        if ($device->device_status != "mode0") {
            $response = [
                'success' => true,
                'message' => 'Device is currently on attendance mode.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

//  ---------------------------- Device Checking ----------------------------

//  ---------------------------- Employee removal ----------------------------

        $employee_info = Employee::where('employee_token_id', $employee_token_id)->where('device_id', $device->id);


        if ($employee_info->count() != 0) {
            $employee_info->delete();


            $attendance_removal = Attendance::where('employee_token_id', $employee_token_id)->get();

            if ($attendance_removal->count() != 0) {
                // If $attendance_removal exists, delete its data
                $attendance_removal->each(function ($attendance) {
                    $attendance->delete();
                });
            }

            $response = [
                'success' => false,
                'message' => 'Data deleted successfully.',
                'employee_token_id' => $employee_token_id
            ];
            return response()->json($response, 200); // Adjust the status code as needed
        } else {

            $response = [
                'success' => false,
                'message' => 'Data does not exists.'
            ];
            return response()->json($response, 200); // Adjust the status code as needed

        }

//  ---------------------------- Employee removal ----------------------------
    }


    public function attendance(Request $request)
    {


        $employee_token_id = $request->get('employee_token_id');
        $device_id = $request->get('device_id');
        $APP_KEY = $request->get('APP_KEY');


        if (config('app.key') != $APP_KEY) {
            $response = [
                'success' => false,
                'message' => 'Invalid App Key'
            ];

            return response()->json($response, 200);
        }

//  ---------------------------- Validation Checking ----------------------------

        // Check if $employee_token_id is not an integer
        if (!is_numeric($employee_token_id) || !is_int($employee_token_id + 0)) {
            $response = [
                'success' => false,
                'message' => 'employee_token_id should be an integer.'
            ];

            return response()->json($response, 400);
        }


        if (empty($employee_token_id) || empty($device_id)) {
            $response = [
                'success' => false,
                'message' => 'Both employee_token_id and device_id are required.'
            ];
            return response()->json($response, 200);
        }

//  ---------------------------- Validation Checking ----------------------------


        // Typecast $employee_token_id to an integer
        $employee_token_id = (int)$employee_token_id;

        //  ---------------------------- Device Checking ----------------------------

        $device = Device::where('device_token', $device_id)->first();

        if (!$device) {
            $response = [
                'success' => false,
                'message' => 'Device not found.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

        if ($device->device_status != "mode1") {
            $response = [
                'success' => true,
                'message' => 'Device is currently on development mode.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

//  ---------------------------- Device Checking ----------------------------


        //  ---------------------------- Employee Checking ----------------------------

        $employee_info = Employee::where('employee_token_id', $employee_token_id)->where('device_id', $device->id);


        if ($employee_info->count() == 0) {
            $response = [
                'success' => false,
                'message' => 'Employee ID with device does not exists'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

//  ---------------------------- Employee Checking ----------------------------

//  ---------------------------- Main Code Structure ----------------------------


        // Find existing record
        $existingAttendance = Attendance::where('employee_token_id', $employee_token_id)
            ->whereDate('date', Carbon::now()->toDateString())
            ->first();

        if ($existingAttendance) {
            // Record already exists, update 'leave_time'
            $existingAttendance->leave_time = Carbon::now()->format('h:i:s A');
            $existingAttendance->save();

            return response()->json([
                'message' => 'User logged out',
                'employee_info' => $employee_info->first()->name ?? 'Set info from dashboard'
            ], 200); // Adjust the status code as needed

        } else {
            // Record does not exist, create a new one
            $employee = Employee::where('employee_token_id', $employee_token_id)->first();

            $attendance = Attendance::create([
                'employee_token_id' => $employee_token_id,
                'device_id' => $device->id,
                'employee_name' => $employee->name ?? "Data Not Found",
                'arrival_time' => Carbon::now()->format('h:i:s A'),
                'leave_time' => null,
                'date' => Carbon::now()->toDateString(),
                'month' => Carbon::now()->format('m'),
                'year' => Carbon::now()->format('Y'),
            ]);

            return response()->json([
                'message' => 'User logged in',
                'employee_info' => $employee_info->first()->name ?? 'Set info from dashboard'
            ], 200); // Adjust the status code as needed


        }


//  ---------------------------- Main Code Structure ----------------------------
        return null;
    }
}
