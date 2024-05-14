<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\Transaction\TransactionService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ResponseTrait;


    private TransactionService $transactionService;


     public function __construct(TransactionService $transactionService){
        $this->transactionService = $transactionService;
     }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function DepositStore(TransactionRequest $request)
    {
      
       try{
        $user = Auth::user(); 
        $successfullTransaction =  $this->transactionService->TransactionStore($request,$user);
       return $this->sendSuccessResponse('Transaction successfully Completed!',$successfullTransaction,200);
       }catch(\Exception $e){
        return $this->sendErrorResponse('Transaction failed to proceed',$e->getMessage(),400);
       }
     
    }
    public function WithdrawalStore(TransactionRequest $request){
        try{
            $user = Auth::user();
            $successfullTransaction =  $this->transactionService->TransactionWithdrawalStore($request,$user);
            return $this->sendSuccessResponse('Transaction successfully Completed!',$successfullTransaction,200);
        }catch(\Exception $e){
            return $this->sendErrorResponse('Transaction failed to proceed',$e->getMessage(),400);
           }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
