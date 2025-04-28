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
    // protected $appends = ['name'];

    // public function getFullnameAttribute()
    // {
    //     return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    // }


    // public function beforeSave(array $data)
    // {
    //     if (isset($data['password'])) {
    //         $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    //     }
    //     return $data;
    // }
    // public function getFullName()
    // {
    //     return $this->firstname . ' ' . $this->lastname;
    // }   

    // public function getFullNameWithParent()
    // {
    //     return $this->getFullName() . ' (' . $this->parent->getFullName() . ')';
    // }

    // public function getFullNameWithChildren()
    // {
    //     return $this->getFullName() . ' (' . $this->children->getFullName() . ')';
    // }

    // public function getFullNameWithChildrenAndParent()
    // {
    //     return $this->getFullName() . ' (' . $this->parent->getFullNameWithChildren() . ')';
    // }

    // public function getFullNameWithChildrenAndParentAndOrders()
    // {
    //     return $this->getFullName() . ' (' . $this->parent->getFullNameWithChildrenAndParentAndOrders() . ')';
    // }

    // public function getFullNameWithChildrenAndParentAndOrdersAndOrders()
    // {
    //     return $this->getFullName() . ' (' . $this->parent->getFullNameWithChildrenAndParentAndOrdersAndOrders() . ')';
    // }

    // public function parent(){
    //     return $this->belongsTo(UserModel::class, 'parent_id');
    // }

    // public function children(){
    //     return $this->hasMany(UserModel::class, 'parent_id');
    // }

    // public function getOrders($personId)
    // {
    //     $orderModel = new \App\Models\OrderModel();
    //     return $orderModel->where('person_id', $personId)->findAll();
    // }

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
