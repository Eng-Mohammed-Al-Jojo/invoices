<?php

namespace App\Http\Controllers;

use App\invoices;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


//================== Charts =====================


    $count_all =invoices::count();
   
   
   
    if($count_all != 0){
            
    
        $count_invoices1 = invoices::where('Value_Status', 1)->count();
        $nspainvoices1 = $count_invoices1/$count_all*100;

        $count_invoices2 = invoices::where('Value_Status', 2)->count();
        $nspainvoices2 = $count_invoices2/ $count_all*100;

        $count_invoices3 = invoices::where('Value_Status', 3)->count();
        $nspainvoices3 = $count_invoices3/ $count_all*100;

    } else {
        $nspainvoices1 = 0;
        $nspainvoices2 = 0;
        $nspainvoices3 = 0;
    }
// ExampleController.php

$chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 200])
         ->labels(['المدفوعة', ' الغير مدفوعة','المدفوعة جزئيا',])
         ->datasets([
             [
                 "label" => "المدفوعة",
                 'backgroundColor' => ['#28B463'],
                 'data' => [ $nspainvoices2]
             ],
             [
                 "label" => "الغير مدفوعة",
                 'backgroundColor' => ['#C0392B'],
                 'data' => [$nspainvoices1]
             ],
             [
                "label" => "المدفوعة جزئيا",
                'backgroundColor' => ['#E67E22'],
                'data' => [ $nspainvoices3]
             ],
           
         ])
        
        ->optionsRaw([
            'legend' => [
                'display' => true,
                'labels' => [
                    'fontColor' => 'black',
                    'fontFamily' => 'Cairo',
                    'fontStyle' => 'bold',
                    'fontSize' => 14,
                     ]
                     ]  ]);   



// ExampleController.php

$chartjs2 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 350, 'height' => 200])
        ->labels(['الغير مدفوعة', ' المدفوعة',' المدفوعة جزئياً'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB','#E67E22'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB','#E67E22'],
                'data' => [$nspainvoices2,$nspainvoices1,$nspainvoices3]
            ]
        ])
        ->optionsRaw([
            'legend' => [
                'display' => true,
                'labels' => [
                    'fontColor' => 'black',
                    'fontFamily' => 'Cairo',
                    'fontStyle' => 'bold',
                    'fontSize' => 14,
                     ]
                     ]  ]);   


        return view('home', compact('chartjs','chartjs2'));


    }





}
