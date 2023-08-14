<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $year=Carbon::now()->format('Y');
        $month=Carbon::now()->format('m');

        $this_month='';
        $this_month_year='';
        $one_month_ago='';
        $one_month_ago_year='';
        $two_month_ago='';
        $two_month_ago_year='';
        $three_month_ago='';
        $three_month_ago_year='';
        $four_month_ago='';
        $four_month_ago_year='';
            if($month==4){
                $this_month=4;
                $this_month_year=$year;
                $one_month_ago=3;
                $one_month_ago_year=$year;
                $two_month_ago=2;
                $two_month_ago_year=$year;
                $three_month_ago=1;
                $three_month_ago_year=$year;
                $four_month_ago=12;
                $four_month_ago_year=$year-1;
            }else if($month==3){
                $this_month=3;
                $this_month_year=$year;
                $one_month_ago=2;
                $one_month_ago_year=$year;
                $two_month_ago=1;
                $two_month_ago_year=$year;
                $three_month_ago=12;
                $three_month_ago_year=$year-1;
                $four_month_ago=11;
                $four_month_ago_year=$year-1;
            }else if($month==2){
                $this_month=2;
                $this_month_year=$year;
                $one_month_ago=1;
                $one_month_ago_year=$year;
                $two_month_ago=12;
                $two_month_ago_year=$year-1;
                $three_month_ago=11;
                $three_month_ago_year=$year-1;
                $four_month_ago=10;
                $four_month_ago_year=$year-1;
            }
            else if($month==1){
                $this_month=1;
                $this_month_year=$year;
                $one_month_ago=12;
                $one_month_ago_year=$year-1;
                $two_month_ago=11;
                $two_month_ago_year=$year-1;
                $three_month_ago=10;
                $three_month_ago_year=$year-1;
                $four_month_ago=9;
                $four_month_ago_year=$year-1;
            }
            else{
                $this_month=$month;
                $this_month_year=$year;
                $one_month_ago=$month-1;
                $one_month_ago_year=$year;
                $two_month_ago=$month-2;
                $two_month_ago_year=$year;
                $three_month_ago=$month-3;
                $three_month_ago_year=$year;
                $four_month_ago=$month-4;
                $four_month_ago_year=$year;
            }
        
        $customer=Customer::count();
        $contract=Contract::count();
        $invoice=Invoice::count();

        $invoice_done=Invoice::where('done','1')->count();
        $invoice_not_done=Invoice::where('done','0')->count();

        $customer_this_month=Customer::whereMonth('created_at', $this_month)->whereYear('created_at', $this_month_year)->count();
        $customer_one_month_ago=Customer::whereMonth('created_at', $one_month_ago)->whereYear('created_at', $one_month_ago_year)->count();
        $customer_two_month_ago=Customer::whereMonth('created_at', $two_month_ago)->whereYear('created_at', $two_month_ago_year)->count();
        $customer_three_month_ago=Customer::whereMonth('created_at', $three_month_ago)->whereYear('created_at', $three_month_ago_year)->count();
        $customer_four_month_ago=Customer::whereMonth('created_at', $four_month_ago)->whereYear('created_at', $four_month_ago_year)->count();

        return response()->json([
            'customer'=>$customer,
            'contract'=>$contract,
            'invoice'=>$invoice,
            'invoice_done'=>$invoice_done,
            'invoice_not_done'=>$invoice_not_done,
            'customer_this_month'=>$customer_this_month,
            'customer_one_month_ago'=>$customer_one_month_ago,
            'customer_two_month_ago'=>$customer_two_month_ago,
            'customer_three_month_ago'=>$customer_three_month_ago,
            'customer_four_month_ago'=>$customer_four_month_ago,
        ]);
    }
}
