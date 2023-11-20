<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TestModel;
use Illuminate\Http\Request;

class TestModelController extends Controller
{
//   ------------------------------- Employee Check -------------------------------
    public function employee_check(Request $request)
    {

        $employee_token_id = $request->get('employee_token_id');

        // Check if $employee_token_id is not an integer
        if (!is_numeric($employee_token_id) || !is_int($employee_token_id + 0)) {
            $response = [
                'success' => false,
                'message' => 'employee_token_id should be an integer.'
            ];

            return response()->json($response, 200);
        }


        $employee_info = Employee::where('employee_token_id', $employee_token_id)->count();


        if ($employee_info != 0) {
            $response = [
                'success' => false,
                'message' => 'Employee ID Already Exists In Database',
                'employee_token_id' => $employee_token_id,
                'status_state' => 0
            ];

            return response()->json($response, 200); // Adjust the status code as needed
        } else {
            $response = [
                'success' => true,
                'message' => 'Employee ID does not exists',
                'employee_token_id' => $employee_token_id,
                'status_state' => 1


            ];

            return response()->json($response, 200); // Adjust the status code as needed
        }

    }


//   ------------------------------- Employee Check -------------------------------
}
