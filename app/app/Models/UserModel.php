<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PersonModel;
use App\Models\OrderModel;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'person_id', 'password', 'role', 'status', 'avatar','created_at', 'updated_at'];
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

    public function getAllUsersWihtPerson()
    {
        return $this->select('users.*, persons.firstname, persons.lastname , persons.phone, persons.email , persons.id as person_id')
        ->join('persons', 'persons.id = users.person_id')
        ->findAll();
    }
    public function getLatestUsersWithPerson($limit = 5)
{
    return $this->select('users.*, persons.firstname, persons.lastname, persons.phone, persons.email, persons.id as person_id')
        ->join('persons', 'persons.id = users.person_id')
        ->orderBy('users.created_at', 'desc')
        ->limit($limit)
        ->findAll();
}
    public function getUserWithPerson($id)
    {
        return $this->select('users.*, persons.firstname, persons.lastname , persons.phone, persons.email , persons.id as person_id')
        ->join('persons', 'persons.id = users.person_id')
        ->where('users.id', $id)
        ->first();
     
    }
 
}
