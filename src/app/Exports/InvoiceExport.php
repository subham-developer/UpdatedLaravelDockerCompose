<?php
namespace App\Exports;
use App\Clients;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $month_val;
    function __construct($month) {
      $this->month_val = $month;
    }
    public function collection()
    {



      $month_val=$this->month_val;
      $month_data_all=[];
      $month_array=[];
      $clients=DB::table('clients')->select('*')->where('deleted',0)->where('invoice_client',1)->get();
      $count=1;    

      foreach($clients as $cl){

        $client=[];    
        $status_count=0;            
        foreach($month_val as $month){                

         $start_date = date('Y-m-01', strtotime('01-'.$month));
         $end_date  = date('Y-m-t', strtotime('01-'.$month));

         $data_count=DB::table('joinings')
         ->where('client_id',$cl->id)
         ->where('deleted',0)
                              // ->orWhereBetween('start_date',[$start_date, $end_date])
                              // ->orWhereBetween('end_date',[$start_date, $end_date])
         ->Where(function($query2) use ($start_date, $end_date){
          $query2->orWhereBetween('start_date',[$start_date, $end_date])
          ->orWhereBetween('end_date',[$start_date, $end_date])
          ->orWhere(function($query) use ($start_date, $end_date)
          {
            $query->where('start_date','<=', $start_date)->where('end_date','>=',$end_date);
          });
        })
         ->count();              

         if($data_count >=1){
          $status_count=1;
        }

        $m=explode('-',$month);
        $m1=explode('-',$month);
        $month_name=date('F-Y ', strtotime('01-'.$month));
        $client['client_name']=$cl->client_name;
        if(!empty($data_count))
          $client[$month_name.'count']= $data_count;   
        else
          $client[$month_name.'count']= ' '; 

        $data = DB::table('monthly_records')   
        ->select('*')   
        ->where('month',$m[0])
        ->where('year',$m[1])
        ->where('payment','!=',1)
        ->where('client_id',$cl->id)
        ->first(); 
        if( $data !=NUll){
          $client[$month_name.'payment']=$data->payment==0 ? 'Not Done': 'Partially Done';
        }else{
          $client[$month_name.'payment']=' ';

        }
        

      }
      if($status_count==1)
        $month_array[]=$client;
    }

    return new Collection([$month_array]);



  }
    public function headings(): array
    {

        $head= [
            'Client Name',
        ];
        foreach ($this->month_val as $val){
          $d=date('F-Y ', strtotime('01-'.$val));
            $head[]="Resourcess Count $d";
            $head[]='Payment '.date('F-Y ', strtotime('01-'.$val));
        }
        return $head;
    }
}
