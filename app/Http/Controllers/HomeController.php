<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
         // Membuat line chart
         $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
         $monthCustom = [
             '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'
         ];

         $getTransactions = [];
         foreach ($monthCustom as $value) {
             $getTransactions[] = Transaction::whereStatus('Disetujui')
                             ->whereMonth('leave_date', $value)
                             ->count();
         }

         return view('home')
         ->with('monthNames',json_encode($monthNames,JSON_NUMERIC_CHECK))
         ->with('getTransactions',json_encode($getTransactions,JSON_NUMERIC_CHECK));
    }
}
