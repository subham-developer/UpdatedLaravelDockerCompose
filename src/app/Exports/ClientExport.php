<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Client::select('client_name','account_name','account_mobile','account_email','billing_address','pan','gst','tan')->get();
    }
    public function headings(): array
    {
        return [
            'Client Name',
            'Finance Name',
            'Finance Mobile No',
            'Finance Email',
            'Billing Address',
            'PAN',
            'GSTN',
            'TAN',
        ];
    }
}
