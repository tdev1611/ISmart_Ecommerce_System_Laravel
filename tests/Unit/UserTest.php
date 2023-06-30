<?php

namespace Tests\Unit;
use App\Models\User;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    public function testCalculateAge()
    {
        $user = new User();
        $user->date_of_birth = '1990-01-01';
        $age = $user->calculateAge();
        
        $this->assertEquals(33, $age);
    }
    
}
