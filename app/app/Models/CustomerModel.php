<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['person_id', 'parent_id', 'type', 'avatar', 'status', 'password', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

        public function getCustomerWithPerson($id)
        {
            return $this->select('customers.*, persons.firstname, persons.lastname , persons.phone, persons.email ')
            ->join('persons', 'persons.id = customers.person_id')
            ->where('customers.id', $id)
            ->first();
        }
        public function getLatestCustomersWithPerson($limit = 5)
        {
            return $this->select('customers.*, persons.firstname, persons.lastname, persons.phone, persons.email, persons.id as person_id')
                ->join('persons', 'persons.id = customers.person_id')
                ->orderBy('customers.created_at', 'desc')
                ->limit($limit)
                ->findAll();
        }
}
