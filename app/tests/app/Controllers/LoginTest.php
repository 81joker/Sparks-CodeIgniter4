<?php

namespace App\Tests\Controllers;

use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;
use App\Models\PersonModel;
use App\Models\UserModel;

class LoginTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    public function testLoginPageLoads()
    {
        $result = $this->get('/login');
        $result->assertStatus(200);
        $result->assertSee('Willkommen zurück! Anmelden');
    }

    public function testLoginWithInvalidData()
    {
        $result = $this->post('/login', [
            'email' => 'invalid-email',
            'password' => '123',
        ]);

        $result->assertOK();
        $result->assertSee('Willkommen zurück! Anmelden');
    }
    public function testLoginSuccess()
    {
        $this->resetServices();
    
        $migrate = \Config\Services::migrations();
        $migrate->latest();
        $personModel = new PersonModel();
        $userModel = new UserModel();
        $personData = [
            'firstname' => 'Laura',
            'lastname' => 'Nehad',
            'email' => 'lauranehad@example.com',
        ];
    
        $personModel->save($personData);
        $personId = $personModel->getInsertID();


        $userModel->save([
            'person_id' => $personId,
            'password'  => password_hash('password', PASSWORD_DEFAULT),
            'avatar'    => null,
            'role'      => 'admin'
        ]);

        $result = $this->post('/login', [
            'email' => 'lauranehad@example.com',
            'password' => 'password'
        ]);
        
        $result->assertStatus(302);
        $result->assertSessionHas('success', "Hello Laura Logged in successfully");
        $result->assertRedirect('/');
        $this->assertTrue(session()->get('logged_in'));
        $this->assertEquals('Laura Nehad', session()->get('name'));
    }

}

