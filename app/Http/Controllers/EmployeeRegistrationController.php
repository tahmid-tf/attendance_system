<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Device;

class EmployeeRegistrationController extends Controller
{
    public function employee_registration(Request $request)
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

        if ($device->device_status == "mode0") {
            $response = [
                'success' => true,
                'message' => 'Device is currently on development mode.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

        if (!$device) {
            $response = [
                'success' => false,
                'message' => 'Device not found.'
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

        if ($device->device_status == "mode0") {
            $response = [
                'success' => true,
                'message' => 'Device is currently on development mode.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

        if (!$device) {
            $response = [
                'success' => false,
                'message' => 'Device not found.'
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

//  ---------------------------- Device Checking ----------------------------

//  ---------------------------- Employee removal ----------------------------

        $employee_info = Employee::where('employee_token_id', $employee_token_id)->where('device_id', $device->id);


        if ($employee_info->count() != 0) {
            $employee_info->delete();

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
}
