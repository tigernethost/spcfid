<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemberTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
         ->type('0668079578', 'rfid')
         ->check('terms')
         ->press('Submit')
         ->seePageIs('/');
    }
}
