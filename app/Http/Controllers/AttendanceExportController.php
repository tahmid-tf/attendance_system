<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Mail\SendExportedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceExportController extends Controller
{


    public function export_data(){
        return Excel::download(new UsersExport(), 'attendance_report.xlsx');
    }

    public function export()
    {

        // Generate the Excel file
        $export = new UsersExport();
        $filePath = storage_path('exports/attendance_report.xlsx');

        // Make sure the directory exists
        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }

        // Export and store the file
        Excel::store($export, 'exports/attendance_report.xlsx', 'public');

        // Get the full path to the stored file
        $fullPath = storage_path('app/public/exports/attendance_report.xlsx');

        // Send the file as an attachment in an email
        $email = 'tahmid.tf1@gmail.com';
        $subject = 'Attendance Report';
        $message = 'Please find the attached attendance report.';

        Mail::to($email)->send(new SendExportedFile($subject, $message, $fullPath));

        // Optionally, you can delete the file after sending the email
        unlink($fullPath);

        // Return the download response
    }
}
