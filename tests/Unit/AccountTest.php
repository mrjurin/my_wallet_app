<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Account;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class AccountTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    

    public function test_add2number_normal(){
        
        $actual = $this->addTwoNumber(1,2);

        $this->assertEquals(3, $actual);
    }
    
    public function test_add2number_string(){
        
        $actual = $this->addTwoNumber("a",2);

        $this->assertEquals(0, $actual);
    }

    public function test_add2number_null(){
        
        $actual = $this->addTwoNumber(null,2);

        $this->assertIsInt($actual);

        $this->assertEquals(0, $actual,"failed test for null testing");
    }

    private function addTwoNumber($param1, $param2)
    {
        if(gettype($param1) == 'integer' && gettype($param2) == 'integer'){
            return $param1 + $param2;
        }

        return 0;
            
    }
}
