<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PersonModel;
use App\Helpers\FileUploadService;
use App\Helpers\ValidationHelper;
use CodeIgniter\Exceptions\RuntimeException;

class CustomerController extends BaseController
{
    protected $format    = 'json';
    protected $customerModel;
    protected $personModel;
    protected $uploadService;
    protected $validateRule;

    public function __construct()
    {
        $this->uploadService = new FileUploadService();
        $this->validateRule = new ValidationHelper();
        $this->customerModel = new CustomerModel();
        $this->personModel = new PersonModel();
    }

    public function index()
    {
      
        $params = $this->getListParams();
        extract($params);
        $query = $this->customerModel->select('customers.id AS customer_id, customers.*, persons.*')
            ->join('persons', 'customers.person_id = persons.id', 'left');

        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('firstname', $search)
                ->orLike('lastname', $search)
                ->orLike('email', $search)
                ->orLike('type', $search)
                ->orLike("CONCAT(firstname, ' ', lastname)", $search)
                ->groupEnd();
        }
        if ($sortField === 'name') {
            $query->orderBy('persons.lastname', $sortDirection);
        } elseif ($sortField === 'email') {
            $query->orderBy('persons.email', $sortDirection);
        }

        $usersData = $query->paginate($perPage);

        foreach ($usersData as &$user) {
            $user['name'] = $user['firstname'] . ' ' . $user['lastname'];
        }
        $data = [
            'customers' => $usersData,
            'pager' => $this->customerModel->pager,
            'search' => $search,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection
        ];
        return view('customers/index', ['customers' => $data]);
    }

    public function show($id)
    {
        $data['customer'] = $this->customerModel->getCustomerWithPerson($id);
        if (!$data['customer']) {
            return redirect()->to('/customers')->with('error', 'Customer not found');
        }
    
        return view('customers/show', $data);
    }

    public function create()
    {
        return view('customers/create');
    }

    public function store()
    {
        $rules = $this->validateRule->ValidationRules('', 'customer');
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $avatar = $this->request->getFile('avatar');
        $avatarPath = $this->uploadService->upload($avatar, 'avatars');

        $personData = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname'  => $this->request->getPost('lastname'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ];

        $personId = $this->personModel->insert($personData);
        $userData = [
            'person_id' => $personId,
            'password'  => password_hash('default123', PASSWORD_DEFAULT),
            'type'      => $this->request->getPost('type') ?? 'instructor',
            'status'    => $this->request->getPost('status') ?? 'inactive',
            'avatar'    => $avatarPath,
        ];

        if (!$this->customerModel->insert($userData)) {
            if ($avatarPath) {
                @unlink(FCPATH . $avatarPath);
            }
            return redirect()->back()->with('errors', $this->customerModel->errors())->withInput();
        }

        return redirect()->to('/customers')
            ->with('success', "{$personData['firstname']} {$personData['lastname']} wurde erfolgreich erstellt");
    }


    public function edit($id)
    {
        $customer = $this->customerModel->getCustomerWithPerson($id);
        return view('customers/edit', ['customer' => $customer]);
    }

    public function update($id = null)
    {
        $customer = $this->customerModel->getCustomerWithPerson($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer nicht gefunden');
        }

        $rules = $this->validateRule->ValidationRules($customer['email'], 'customer');

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


        $customer = $this->customerModel->find($id);
        $oldAvatarPath = $customer['avatar'] ?? null;
        $avatar = $this->request->getFile('avatar');
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

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


        $data = [
            'type'   => $this->request->getPost('type'),
            'status'    => $this->request->getPost('status'),
        ];

        if ($avatarPath) {
            $data['avatar'] = $avatarPath;
        }

        $this->personModel->update($customer['person_id'], $personData);
        $db = \Config\Database::connect();
        $db->table('customers')
            ->set($data)
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->where('id', $id)
            ->update();

        return redirect()->to('/customers')
            ->with('success', "{$personData['firstname']} {$personData['lastname']} wurde erfolgreich aktualisiert");
    }

    public function delete($id)
    {
        $customer = $this->customerModel->find($id);
        if (!empty($customer['avatar'])) {
            $this->uploadService->deleteOldFile($customer['avatar']);
        }
        $this->personModel->delete($customer['person_id']);
        // $this->customerModel->delete($id); 
        return redirect()->to('/customers')->with('success', 'Customer erfolgreich gelöscht');
    }
}
