<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Helpers\FileUploadService;
use CodeIgniter\Exceptions\RuntimeException;
use App\Helpers\ValidationHelper;
use App\Models\PersonModel;


class UserController extends BaseController
{
    protected $userModel;
    protected $uploadService;
    protected $validateRule;
    protected $personModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->uploadService = new FileUploadService();
        $this->validateRule = new ValidationHelper();
        $this->personModel = new PersonModel();
    }

    public function index()
    {
        $params = $this->getListParams();
        extract($params);

        $query = $this->userModel->select('users.id AS user_id, users.*, persons.*')
            ->join('persons', 'users.person_id = persons.id', 'left');


        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('firstname', $search)
                ->orLike('lastname', $search)
                ->orLike('email', $search)
                ->orLike('role', $search)
                ->orLike("CONCAT(firstname, ' ', lastname)", $search)
                ->groupEnd();
        }
        if ($sortField === 'name') {
            $query->orderBy('persons.lastname', $sortDirection)
                ->orderBy('persons.firstname', $sortDirection);
        } elseif ($sortField === 'email') {
            $query->orderBy('persons.email', $sortDirection);
        }

        $usersData = $query->paginate($perPage);

        foreach ($usersData as &$user) {
            $user['name'] = $user['firstname'] . ' ' . $user['lastname'];
        }

        $data = [
            'users' => $usersData,
            'pager' => $this->userModel->pager,
            'search' => $search,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection
        ];
        return view('users/index', ['users' => $data]);
    }


    public function show($id)
    {
        $data['user'] = $this->userModel->getUserWithPerson($id);
        if (!$data['user']) {
            return redirect()->to('/users')->with('error', 'User not found');
        }

        return view('users/show', $data);
    }
    public function create()
    {
        $person_id = $this->request->getGet('person_id');
        return view('users/create', ['person_id' => $person_id]);
    }


    public function store()
    {
        $rules = $this->validateRule->ValidationRules();
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $personData = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname'  => $this->request->getPost('lastname'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ];

        $personId = $this->personModel->insert($personData);

        $avatar = $this->request->getFile('avatar');
        try {
            $avatarPath =  $this->uploadService->upload($avatar, 'avatars');
        } catch (RuntimeException $e) {
            return redirect()->back()
                ->with('errors', ['avatar' => $e->getMessage()])
                ->withInput();
        }

        $userData = [
            'person_id' => $personId,
            'password'  => password_hash('default123', PASSWORD_DEFAULT),
            'role'      => $this->request->getPost('role') ?? 'instructor',
            'status'    => $this->request->getPost('status') ?? 'inactive',
            'avatar'    => $avatarPath,
        ];

        if (!$this->userModel->insert($userData)) {
            if ($avatarPath) {
                @unlink(FCPATH . $avatarPath);
            }
            return redirect()->back()->with('errors', $this->userModel->errors())->withInput();
        }

        return redirect()->to('/users')
            ->with('success', "{$personData['firstname']} {$personData['lastname']} wurde erfolgreich erstellt");
    }


    public function edit($id)
    {
        $user = $this->userModel->getUserWithPerson($id);
        return view('users/edit', ['user' => $user]);
    }


    public function update($id = null)
    {
        // dd($this->request->getPost());
        $user = $this->userModel->getUserWithPerson($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Benutzer nicht gefunden');
        }

        $rules = $this->validateRule->ValidationRules($user['email']);

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        $personData = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname'  => $this->request->getPost('lastname'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ];

        $user = $this->userModel->find($id);
        $oldAvatarPath = $user['avatar'] ?? null;
        $avatar = $this->request->getFile('avatar');
        $avatarPath = null;
        try {
            $avatarPath = $this->uploadService->updateFile(
                $avatar,
                'avatars',
                $oldAvatarPath
            );
        } catch (RuntimeException $e) {
            return redirect()->back()
                ->with('errors', ['avatar' => $e->getMessage()])
                ->withInput();
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $data = [
            'role'   => $this->request->getPost('role'),
            'status'    => $this->request->getPost('status'),
        ];

        if ($avatarPath) {
            $data['avatar'] = $avatarPath;
        }
        $this->personModel->update($user['person_id'], $personData);
        $db = \Config\Database::connect();
        $db->table('users')
            ->set($data)
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->where('id', $id)
            ->update();

        return redirect()->to('/users')
            ->with('success', "{$personData['firstname']} {$personData['lastname']} wurde erfolgreich aktualisiert");
    }



    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/users')->with('errors', ['Benutzer nicht gefunden.']);
        }
        $this->personModel->delete($user['person_id']);
        return redirect()->to('/users')->with('success', 'Benutzer erfolgreich gelöscht');
    }


}
