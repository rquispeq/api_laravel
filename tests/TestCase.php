<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    public $baseUrl = '/api/v1/';

    public function setUp():void{
        parent::setUp();

        $this->signIn();
    }
    
    public function signIn(){
        Passport::actingAs(create(User::class));
    }

}
