<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\HouseHold;

class AddHouseHoldTest extends TestCase
{
    use RefreshDatabase;
    /*
    *
    Testing creating household
    */
    /** @test */
    public function createHouseHold(){
        $response=$this->post('api/save-household',[
            'item_name'=>'matress',
            'expected_price'=>'400000',
            'actual_price'=>'300000',
            'status'=> 'bought'
        ]);
            $this->assertCount(1,HouseHold::all());
    }
     /*
    *
    Displaying all the household
    */
    /** @test */
    public function displayHouseHold(){
        $response = $this->get('api/display-household');

        $response->assertStatus(200);
    }
     /*
    *
    displaying one item household
    */
    /** @test */
    public function displayParticularHouseHold(){
        $this->createHouseHold();
        $item = HouseHold::first();
        $response = $this->get('api/display-particular-household/'.$item->id);

        $response->assertStatus(200);
    }
     /*
    *
    Changing bought status of household to not bought
    */
    /** @test */
    public function updateToBought(){
        $this->createHouseHold();
        $delete_not_bought = HouseHold::first();
        $response = $this->delete('api/update-household/'.$delete_not_bought->id);
        $this->assertEquals('bought', HouseHold::first()->status);
    }
     /*
    *
    mark household status to bought
    */
    /** @test */
    public function markAsBought(){
        $this->createHouseHold();
        $mark_as_bought = HouseHold::first();
        $response = $this->delete('api/mark-as-bought/'.$mark_as_bought->id);
        $this->assertCount(1, HouseHold::all());
    }
     /*
    *
    Delete household permanently
    */
    public function deleteHouseholdPermanently(){
        $this->createHouseHold();
        $delete_permanently = HouseHold::first();
        $response = $this->delete('api/delete-permanently/'.$delete_permanently->id);
        $this->assertCount(1, HouseHold::all());
    }
}
