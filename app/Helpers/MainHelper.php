<?php 
namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Transaction;

class MainHelper{
    public static function CreateTransaction($data = []){
        $isTransaction = Transaction::create([
            'user_id' => $data['user_id'], 
            'transaction_type' => $data['transaction_type'], 
            'amount' => $data['amount'], 
            'fee' => $data['fee'], 
            'date' => Carbon::now()
        ]);

        return $isTransaction ? true : false;
    }

    public static function fee($userId = null, $amount, $accountType = 'individual'){
        $fee = 0;

        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        //Sum the total amount for records in the current month
        $currentMonthTotalWithdraw = Transaction::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
        ->where(['user_id' => $userId, 'transaction_type' => 'withdraw'])
        ->sum('amount');

        if($accountType == 'individual'){
            $percentage = 0.015;

            $currentDate = Carbon::now();
            $isFriday = $currentDate->dayOfWeek === Carbon::FRIDAY;
            
            //Friday free charge
            if($isFriday){
                return 0;
            }
               
            //The first 5K withdrawal each month is free.
            if($currentMonthTotalWithdraw <= 5000){
                return 0;
            }

            //The first 1K withdrawal per transaction is free
            $fee = ($percentage / 100 ) * ($amount - 1000);

            return $fee;

        }elseif($accountType == 'business'){
            $percentage = 0.025;
            if($currentMonthTotalWithdraw > 50000){
                $percentage = 0.015;
            }

            $fee = ($percentage / 100 ) * $amount;
            return $fee;
        }

        

       

        return $fee;
        
    }
}