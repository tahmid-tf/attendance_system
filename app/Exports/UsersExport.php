<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Attendance::select('employee_name', 'arrival_time', 'leave_time', 'date', 'employee_token_id')->orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Arrival Time',
            'Leave Time',
            'Report Date',
            'Employee ID',
        ];
    }

//    public function registerEvents(): array
//    {
//        return [
//            AfterSheet::class => function (AfterSheet $event) {
//                $event->sheet->getStyle('A1:E1')->applyFromArray([
//                    'font' => [
//                        'bold' => true,
//                    ],
//                ]);
//            },
//        ];
//    }
}


