<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['transactions'] = Transaction::orderBy('id', 'desc')->simplePaginate();
        return view('frontend.pages.dashboard', $data);
    }
    //End
}
