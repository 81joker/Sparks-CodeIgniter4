<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderLineModel extends Model
{
    protected $table            = 'order_line';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['customer_id', 'order_id', 'quantity' , 'created_at', 'updated_at']; 

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

 
        
  
    protected $validationMessages   = [
        'quantity' => 'required|integer|greater_than[0]',
        'price'    => 'required|integer|greater_than[0]',
        'product_id' => 'required|integer|greater_than[0]',
        'order_id' => 'required|integer|greater_than[0]',
    ];
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
// Order → OrderLine (One-to-Many)

// OrderLine → Product (Many-to-One)

// Order → Customer (Many-to-One)


    // public function order()
    // {
    //     return $this->belongsTo(OrderModel::class, 'OrderID');


    // public function product()
    // {
    //     return $this->belongsTo(ProductModel::class, 'ProductID');
    // }

    // public function getAllOrderWithCustomer()
    // {
    //     return $this->select('orders.id AS order_id ,orders.order_status , orders.*, customers.*, persons.firstname,persons.lastname, persons.email')
    //     ->join('customers', 'orders.customer_id = customers.id', 'left')
    //     ->join('persons', 'customers.person_id = persons.id', 'left')
    //     ->first();
    // }

    public function getAllOrderWithCustomer()
    {
        return $this->db->table('order_line')
            ->select('orders.id AS order_id, orders.order_status, orders.created_at AS order_created, customers.*, persons.firstname, persons.lastname, persons.email')
            ->join('orders', 'order_line.order_id = orders.id', 'left')
            ->join('customers', 'orders.customer_id = customers.id', 'left')
            ->join('persons', 'customers.person_id = persons.id', 'left')
            ->limit(10)
            ->get()
            ->getResultArray();
    }
    
//     public function getAllOrderWithDetails()
// {
//     return $this->db->table('order_line')
//         ->select('order_line.*, products.name AS product_name, products.price, products.image ,products.description , products.id As product_id')
//         ->join('products', 'products.id = order_line.product_id')
        
//         ->limit(10)
//         ->get()
//         ->getResultArray();
// }

public function getAllOrderWithDetails()
{
    return $this->db->table('order_line')
        ->select('order_line.*, products.name AS product_name,customers.id AS customer_id, orders.id AS order_id, orders.order_status, orders.created_at AS order_created, products.price, products.image, products.description, products.id AS product_id, persons.firstname, persons.lastname')
        ->join('products', 'products.id = order_line.product_id')
        ->join('orders', 'orders.id = order_line.order_id', 'left')
        ->join('customers', 'customers.id  = orders.customer_id', 'left')
        ->join('persons', 'persons.id = customers.person_id', 'left')
        ->limit(10)
        ->get()
        ->getResultArray();
} 

    // Calculate line total
    public function lineTotal()
    {
        return $this->product->Price * $this->quantity;
    }
   

}
