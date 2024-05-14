<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\User\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ResponseTrait;

    private UserService $userService;


    public function __construct(UserService $userService){
        $this->userService = $userService;
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
    public function store(UserRequest $request)
    {
        try {
            $createdUser = $this->userService->createUser($request);
         
            return  $this->sendSuccessResponse('User created successfully',$createdUser, 201);
         
        } catch (\Exception $e) {
            $this->sendErrorResponse('User created failed',$e->getMessage(), 400);
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

    public function login(Request $request){
    
        try {
            $loggedUser = $this->userService->login($request);
            return $this->sendSuccessResponse('User logged in successfully',$loggedUser,201);
        } catch (\Exception $e) {
            return $this->sendErrorResponse('User logged in failed',$e->getMessage(),400);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->sendSuccessResponse('User logged out successfully');
 
    }

    public function showDepositBalance(Request $request){
        $userWithTransactions = $this->userService->showDepositBalance($request);
        return $this->sendSuccessResponse('User Deposit Fetched!',$userWithTransactions);
    }

    public function showWithdrawalBalance(Request $request){
        $userWithTransactions = $this->userService->showWithdrawalBalance($request);
        return $this->sendSuccessResponse('User Withdraw Fetched!',$userWithTransactions);
    }
}
