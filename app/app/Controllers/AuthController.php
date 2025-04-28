<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PersonModel;
use App\Models\CustomerModel;
use App\Helpers\FileUploadService;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\RuntimeException;


class AuthController extends BaseController
{
    protected $uploadService;
    protected $personModel;
    protected $userModel;
    protected $customerModel;
    protected $validateRule;

    public function __construct()
    {
        $this->validateRule = new \App\Helpers\ValidationHelper();
        $this->uploadService = new FileUploadService();
        $this->personModel = new PersonModel();
        $this->userModel = new UserModel();
        $this->customerModel = new CustomerModel();
        helper(['form', 'url', 'session']);
    }
    public function register()
    {
    
        if ($this->request->getMethod() === 'get') {
            return view('auth/register');
        }
    
        $rules = [
            'firstname' => 'required|min_length[3]|max_length[30]',
            'lastname' => 'required|min_length[3]|max_length[30]',
            'email' => 'required|valid_email|is_unique[persons.email]', 
            'password' => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'matches[password]',
            'role' => 'required|in_list[admin,instructor,parent,child]', 
            'avatar' => [
                "rules" => "if_exist|max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]",
                'errors' => [
                    'uploaded' => 'Please select an avatar image',
                    'is_image' => 'Only image files (jpg, png, gif) are allowed'
                ]
            ]
        ];
    
        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validator,
                redirect()->back()->withInput()

            ]);
        }

        $avatar = $this->request->getFile('avatar');    
        try {
            $avatarPath = $this->uploadService->upload($avatar, 'avatars');
        } catch (RuntimeException $e) {
            return redirect()->back()
                ->with('errors', ['avatar' => $e->getMessage()])
                ->withInput();
        }
    
        $personData = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'email' => $this->request->getPost('email'),
            'phone' => '', 
        ];
    
        $this->personModel->save($personData);
        $personId = $this->personModel->getInsertID();
    

        $role = $this->request->getPost('role');
        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        
        if (in_array($role, ['admin', 'instructor'])) {
            $userData = [
                'person_id' => $personId,
                'password' => $passwordHash,
                'role' => $role,
                'avatar' => $avatarPath
            ];
            $this->userModel->save($userData);
    
            $user = $this->userModel->where('person_id', $personId)->first();
            $userType = 'user';
        } else {
            $type = ($role == 'parent') ? 'parent' : 'child';
            $customerData = [
                'person_id' => $personId,
                'password' => $passwordHash,
                'type' => $type,
                'avatar' => $avatarPath
            ];
            $this->customerModel->save($customerData);
            $userType = 'customer';
            $user = $this->customerModel->where('person_id', $personId)->first();
        }
    
        if ($userType === 'user') {
            $sessionData['role'] = $user['role']; 
        } else {
            $sessionData['type'] = $user['type']; 
        }
    

        session()->set([
            'id' => $user['id'],
            'name' => $personData['firstname'] . ' ' . $personData['lastname'],
            'email' => $personData['email'],
            'avatar' => $user['avatar'] ?? null,
            'logged_in' => true,
            'user_type' => $userType,
        ]);
    
        return redirect()->to('/')->with('success', 'Hallo ' . $personData['firstname'] . '! Du wurdest erfolgreich gespeichert');
    }
    


    public function login()
    {
        if ($this->request->getMethod() === 'get') {
            return view('auth/login');
        }
    
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]'
        ];
    
        $messages = [
            'email' => [
                'required' => 'Email is required',
                'valid_email' => 'Please enter a valid email address'
            ],
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 8 characters'
            ]
        ];
    
        if (!$this->validate($rules, $messages)) {
            return view('auth/login', [
                'validation' => $this->validator,
                redirect()->back()->withInput()
            ]);
        }

    
        $email = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));
    
        $person = $this->personModel->where('email', $email)->first();
    
        if (!$person) {
            session()->setFlashdata('error', 'Person nicht gefunden. Bitte versuchen Sie es erneut.');
            return redirect()->back()->withInput();
        }
    
        $user = $this->userModel->where('person_id', $person['id'])->first();
        $userType = 'user'; 
    
        if (!$user) {
            $user = $this->customerModel->where('person_id', $person['id'])->first();
            $userType = 'customer';
        }
    
        if (!$user) {
            session()->setFlashdata('error', 'Benutzer nicht gefunden. Bitte überprüfen Sie Ihre Anmeldeinformationen.');
            return redirect()->back()->withInput();
        }
    
        if (!password_verify($password, $user['password'])) {
            session()->setFlashdata('error', 'Ungültiges Passwort. Bitte versuchen Sie es erneut.');
            return redirect()->back()->withInput();
        }
    
        $sessionData = [
            'id' => $user['id'],
            'name' => $person['firstname'] . ' ' . $person['lastname'],
            'email' => $person['email'],
            'avatar' => $user['avatar'] ?? null,
            'logged_in' => true,
            'user_type' => $userType, 
        ];
    
        if ($userType === 'user') {
            $sessionData['role'] = $user['role']; 
        } else {
            $sessionData['type'] = $user['type']; 
        }
    
        session()->set($sessionData);
    
        return redirect()->to('/')->with('success', 'Hello ' . $person['firstname'] . ' Logged in successfully');
    }
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
