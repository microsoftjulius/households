<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthenticationController extends Controller
{
    /**
     * This function takes the user model and its object,
     * we use the object to create a new account user.
     */
    protected function createAccount(){
        $account = new User();
        $account->name     = request()->name;
        $account->email    = request()->email;
        $account->password = Hash::make(request()->password);
        $account_status    = 'active';
        $account->save();
    }

    /**
     * This function helps us to get all the users,
     * it return response to a user having all the users in Json format
     */
    protected function getAllUsers(){
        $users = User::all();
        return response()->json(['Users' => $users]);
    }

    /**
     * This function takes a Users ID whose account is to be deleted
     */
    protected function deleteMyAccount($id){
        User::find($id)->update(['status' => 'deleted']);
        return response()->json(['message' => 'Account has been deleted Successfully']);
    }

    /**
     * This function us where we do the code validation
     */
    protected function validateAccountCredantials(){
        if(empty(request()->name)){
            return response()->json(['error' => 'Please enter your name to continue']);
        }
        if(empty(request()->email)){
            return response()->json(['error' => 'Please enter an Email to continue']);
        }
        if(empty(request()->password)){
            return response()->json(['error' => 'Please enter a password to continue']);
        }
        if(empty(request()->c_password)){
            return response()->json(['error' => 'Please enter a password to continue']);
        }
        if(strlen(request()->password) < 6){
            return response()->json(['error' => 'A password must have greater than 6 characters']);
        }
        if(request()->password != request()->c_password){
            return response()->json(['error' => 'Make sure the two password match']);
        }
        if (preg_match("/.;*-'\|@#$%^&()/", request()->password))
        {
            return response()->json(['error' => 'A password cannot have special tags']);
        }else{
            return $this->createAccount();
        }
    }
}
