<?php

namespace App\Exports;

use App\Repositories\HomeRepo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BenchExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $HomeRepo = new HomeRepo();
        return  new Collection([
            $HomeRepo->onBenchResourceExport()
        ]);
    }
    public function headings(): array
    {
        return [
            'Employee Name',           
            'Total Experience',           
            'Idle Days',
            'Techonology',
        ];
    }
}
