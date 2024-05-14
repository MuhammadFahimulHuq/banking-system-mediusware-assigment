<?php
namespace App\Services\User;
use App\Models\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;


class UserService {



    public function createUser($request){
        $user = User::create([
            'name' => $request->name,
             'balance' => $request->balance,
             'account' => $request->account_type,
             'email' => $request->email,
             'password' => Hash::make($request->password),   
        ]) ;   

     return $user;
    }
    public function login($request){
        $user = User::where('email',  $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) 
                {
                    throw new \Exception('email or password is not correct.');
                }

                $user->tokens()->delete();

                $data = ([
                    'name' => $user->name,
                    'token' => $user->createToken('auth_token')->plainTextToken,
                ]);
                return $data;
    }

    
    public function  showDepositBalance($request){
        $user =  $request->user();
        $userWithTransactions = User::with(['transactions' => function($query) {
         $query->where('transaction_type', 'deposit');
          }])->find($user->id);
        return $userWithTransactions;
    }
    public function showWithdrawalBalance($request){
        $user =  $request->user();
        $userWithTransactions = User::with(['transactions' => function($query) {
            $query->where('transaction_type', 'withdrawal');
        }])->find($user->id);

        return $userWithTransactions;
    }
}