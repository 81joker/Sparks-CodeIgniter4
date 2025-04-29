<?php

namespace App\Tests\Unit;

use App\Models\UserModel;
use App\Models\PersonModel;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Controllers\UserController;
use SimpleXMLElement;

final class UserControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;
    private $personId;
    protected function setUp(): void
    {
        parent::setUp();

        $migrations = Services::migrations();
        $migrations->latest();

        $personModel = new PersonModel();
        $this->personId = $personModel->insert([
            'firstname' => 'Test',
            'lastname'  => 'User',
            'email'     => 'unit_' . time() . '@example.com',
            'phone'     => '1234567890'
        ]);
    }

    public function testUserCanBeCreated(): void
    {
        $model = new UserModel();

        $userId = $model->insert([
            'person_id' => $this->personId,
            'password'  => password_hash('test123', PASSWORD_DEFAULT),
            'role'      => 'instructor',
            'status'    => 'active',
            'avatar'    => 'images/dummy.jpg'
        ]);

        $this->assertIsInt($userId, 'User was not created correctly.');

        $user = $model->find($userId);
        $this->assertNotNull($user);
        $this->assertEquals('instructor', $user['role']);
    }

    public function testUserWithPersonDataCanBeRetrieved(): void
    {
        $model = new UserModel();

        $userId = $model->insert([
            'person_id' => $this->personId,
            'password'  => password_hash('test123', PASSWORD_DEFAULT),
            'role'      => 'instructor',
            'status'    => 'active',
            'avatar'    => 'images/dummy.jpg'
        ]);

        $userWithPerson = $model->getUserWithPerson($userId);
        
        $this->assertNotNull($userWithPerson);
        $this->assertEquals('Test', $userWithPerson['firstname']);
        $this->assertEquals('User', $userWithPerson['lastname']);
    }


    public function testApiReturnsValidJsonResponse(): void
    {
        $result = $this->withUri('http://localhost:8000/users/api')
            ->controller(\App\Controllers\Api\UserController::class)
            ->execute('api');
        
        $this->assertTrue($result->isOK());
        $json = $result->getJSON();
        $data = json_decode($json, true);
        $this->assertIsArray($data['users']);
    }

    public function testApiReturnsValidXmlResponse(): void
    {
        $testResponse = $this->withUri('http://localhost:8000/users/api/xml')
            ->controller(\App\Controllers\Api\UserController::class)
            ->execute('apiXml');
        
        $testResponse->assertOK();
        $testResponse->assertHeader('Content-Type', 'application/xml');
        
        $xml = simplexml_load_string($testResponse->getBody());
        $this->assertInstanceOf(\SimpleXMLElement::class, $xml);
    }

    
    protected function tearDown(): void
    {
        $userModel = new UserModel();
        $userModel->where('person_id', $this->personId)->delete();

        $personModel = new PersonModel();
        $personModel->delete($this->personId);

        parent::tearDown();
    }
}