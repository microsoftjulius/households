<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HouseHold;

class HouseHoldController extends Controller
{
    
    //function to create household
    public function createHouseHold(Request $request){
        HouseHold::create(array(
            'item_name'=>request()->item_name,
            'expected_price'=>request()->expected_price,
            'actual_price'=>request()->actual_price
        ));
        return response()->json(['message'=>"You have saved the Household successfully"]);
    }
    //Function to display all households
    public function displayHouseHold(){
        $get_household = HouseHold::where('status', 'not bought')->get();
        return response()->json(['message'=>$get_household]);
    }
    //Function to display particular household
    public function displayParticularHouseHold($id){
        $get_particular_household = HouseHold::where('id',$id)->get();
        return response()->json(['message'=>$get_particular_household]);
    }
    //Function to update house status to bought
    public function updateToBought($id){
        HouseHold::where('id',$id)->update(array('status' =>'bought'));
        return response()->json(['message'=>"You have update the Household successfully"]);
    }
    //Function to change household status to not bought
    public function markAsNotBought($id){
        HouseHold::where('id',$id)->update(array('status'=>'not bought'));
        return response()->json(['message'=>'You have marked the Household successfully']);
    }
    //Function to delete household permanently
    public function deleteHouseholdPermanently($id){
        HouseHold::where('id',$id)->delete();
        return response()->json(['message'=>'You have marked the Household successfully']);
    }
}
