<?php

namespace App\Tests\Controllers;

use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use App\Models\PersonModel;
use App\Models\UserModel;
use CodeIgniter\Test\DatabaseTestTrait;

class RegisterTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;

    public function testRegisterPageLoads()
    {
        $result = $this->get('/register');
        $result->assertStatus(200);
        $result->assertSee('Willkommen! Registrieren');
    }

    public function testRegisterWithInvalidData()
    {
        $result = $this->post('/register', [
            'email' => 'invalid-email',
            'password' => '123',
        ]);

        $result->assertOK();
        $result->assertSee('Willkommen! Registrieren');
    }

    public function testRegisterSuccess()
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

