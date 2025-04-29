<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use App\Controllers\BaseController;



class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function apiJson()
    {;
        $data['users'] = $this->userModel->findAll();
        return $this->response->setJSON($data);
    }
    public function apiXml()
    {
        $data['users'] = $this->userModel->findAll();
        return $this->response->setXML($data);
    }
    public function apiCsv()
    {
        $users = $this->userModel->findAll();
        $csvData = '';
        if (!empty($users)) {
            $csvData .= implode(',', array_keys((array)$users[0])) . "\n";
        }
        foreach ($users as $user) {
            $csvData .= implode(',', array_map(function ($value) {
                return '"' . str_replace('"', '""', $value) . '"'; // Escape quotes
            }, (array)$user)) . "\n";
        }
        return $this->response->setBody($csvData)
            ->setContentType('text/plain');

        //  To export as CSV
        // helper('csv');
        // return generateCsvResponse($data, 'users.csv');

    }

}