<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'customer_id', 'order_status', 'image', 'order_number', 'cost', 'total_amount', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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
    public function getOrderWithCustomer($orderId)
    {
        return $this->select([
            'orders.id AS order_id',
            'orders.order_number',
            'orders.order_status',
            'orders.cost',
            'orders.total_amount',
            'orders.created_at',
            'orders.updated_at',
            'customers.id AS customer_id',
            'customers.avatar',
            'customers.person_id',
            'customers.type AS customer_type',
            'persons.firstname',
            'persons.lastname',
            'persons.email',
            'persons.phone'
        ])
            ->join('customers', 'orders.customer_id = customers.id', 'left')
            ->join('persons', 'customers.person_id = persons.id', 'left')
            ->where('orders.id', $orderId)
            ->first();
    }


    public function getOrderWithDetails($id)
    {
        return $this->db->table('order_line')
            ->select('order_line.*, products.name AS product_name, products.price, products.image ')
            ->join('products', 'products.id = order_line.product_id')
            ->where('order_line.order_id', $id)
            ->get()
            ->getResultArray();
    }
}
