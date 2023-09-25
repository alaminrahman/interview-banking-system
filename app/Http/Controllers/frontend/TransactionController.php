<?php

namespace App\Http\Controllers\frontend;

use App\Helpers\MainHelper;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TransactionController extends Controller
{

    public function depositForm(){
        return view('frontend.pages.transactions.deposit.create');
    }

    public function storeDeposit(Request $request){
        $validated = $this->validate($request,[
            'user_id' => 'required',
            'amount' => 'required|integer',
        ], [
            'user_id.required' => 'Please select user account!'
        ]);

        DB::beginTransaction();
        try{
            $user = User::find($validated['user_id']);
            $user->balance += $validated['amount'];
            $user->save();

            //Prepare Data
            $transaction = [
                'user_id' => $validated['user_id'], 
                'transaction_type' => 'deposit', 
                'amount' => $validated['amount'], 
                'fee' => 0
            ];

            MainHelper::CreateTransaction($transaction);

            DB::commit();

            return redirect()->back()->with('success', 'Amount Deposited!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage().' '. $e->getLine());
        }

    }

    public function deposit(){
        $data['deposits'] = Transaction::where('transaction_type', 'deposit')->orderBy('id', 'desc')->simplePaginate();
        return view('frontend.pages.transactions.deposit.index', $data);
    }

    public function withdrawTransactions(){
        $data['withdraws'] = Transaction::where('transaction_type', 'withdraw')->orderBy('id', 'desc')->simplePaginate();
        return view('frontend.pages.transactions.withdraw.index', $data);
    }

    public function withdrawRequest(Request $request){
        $validated = $this->validate($request,[
            'user_id' => 'required',
            'amount' => 'required|integer',
        ], [
            'user_id.required' => 'Please select user account!'
        ]);

        $user = User::find($validated['user_id']);
        $balance = $user ? $user->balance : 0;

        if($balance < $validated['amount']){
            return redirect()->back()->with('error', 'Insufficient balance');
        }

        $fee = MainHelper::fee($validated['user_id'], $validated['amount'], auth()->user()->account_type);

        DB::beginTransaction();
        try{
            
            $user->balance -= $validated['amount'];
            $user->save();

            //Prepare Data
            $transaction = [
                'user_id' => $validated['user_id'], 
                'transaction_type' => 'withdraw', 
                'amount' => $validated['amount'], 
                'fee' => $fee
            ];

            MainHelper::CreateTransaction($transaction);

            DB::commit();

            return redirect()->back()->with('success', 'Amount withdraw successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage().' '. $e->getLine());
        }


    }
    
    //End
}
