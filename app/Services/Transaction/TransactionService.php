<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;



class TransactionService{
    public function TransactionStore($request,$user){

     
        if($request->transaction_type == 'deposit'){
            
            $transaction = new Transaction();
            $transaction->transaction_type = $request->transaction_type;
            $transaction->user_id = $user->id;
            $transaction->amount = $request->amount;
            $transaction->save();

            $user = User::where('id',$user->id)->first() ;
            $currentBalance = $user->balance ;
            $newBalance = $currentBalance + $request->amount;
            $user->balance = $newBalance;
            $user->save();
        }
       

        return $transaction;

        }

        public function calculateFees($amountToDeposit, $account_type) {
            $fee = 0;
            if ($account_type == 'individual') {
                $fee = $amountToDeposit * 0.015;
            } elseif ($account_type == 'business') {
                $fee = $amountToDeposit * 0.025;
            }
            return $fee;
        }
        

        public function TransactionWithdrawalStore($request, $user){
       
            if($request->transaction_type == 'withdrawal' ){
                
                if($request->amount > $user->balance ){
                    throw new \Exception('Insufficient balance for the withdrawal.');
                }
        
                $transaction = new Transaction();
                $transaction->transaction_type = $request->transaction_type;
                $transaction->user_id = $user->id;
        
                $amountToWithdraw = $request->amount;

                $totalWithdrawAmount = Transaction::where('user_id', $user->id)
                ->where('transaction_type', 'withdrawal')
                ->sum('amount');
         
                if (Carbon::now()->dayOfWeek != Carbon::FRIDAY) {
                    $currentMonth = Carbon::now()->startOfMonth();

                    $totalWithdrawalThisMonth = Transaction::where('user_id', $user->id)
                    ->where('created_at', '>=', $currentMonth)
                    ->where('transaction_type', 'withdrawal')
                    ->sum('amount');
                    

                 
                      
                        if($user->account_type == 'business' &&  $totalWithdrawAmount >= 50000){
                                    $fee  = $amountToWithdraw  * 0.015;
                                    $amountToWithdraw -= $fee;
                                    $transaction->fee = $fee;
                            
                            }else{
                                if($totalWithdrawalThisMonth >= 5000){
                                    if ($totalWithdrawAmount < 1000  && $amountToWithdraw > 1000 ) {
                                        $fee = $this->calculateFees($amountToWithdraw - 1000, $user->account_type);
                                        $amountToWithdraw -= $fee;
                                        $transaction->fee = $fee;
                                    }else{
                                        $fee = $this->calculateFees($amountToWithdraw , $user->account_type);
                                        $amountToWithdraw -= $fee;
                                        $transaction->fee = $fee;
                                    }
                                }
                                else {
                                    $transaction->fee = 0;
                                }
                            }
                      
                    } else {
                        $transaction->fee = 0; 
                    }

                
        
                $transaction->amount = $amountToWithdraw;
                $transaction->save();
        
          
                $user->balance -= $transaction->amount; 
                $user->save();
            }
        
            return $transaction;
        }

    }        