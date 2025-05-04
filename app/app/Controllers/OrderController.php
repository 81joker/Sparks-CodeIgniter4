<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Helpers\ValidationHelper;
use App\Helpers\FileUploadService;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{

    protected $orderModel;
    protected $uploadService;
    protected $validateRule;
    // protected $personModel;

    public function __construct()
    {
        $this->orderModel = new orderModel();
        $this->uploadService = new FileUploadService();
        $this->validateRule = new ValidationHelper();
        // $this->personModel = new PersonModel();
    }
    public function index()
    {
        $params = $this->getListParams();
        extract($params);
            $query = $this->orderModel
    ->select([
        'orders.id AS order_id',
        'orders.order_number',
        'orders.order_status',
        'orders.cost',
        'orders.total_amount',
        'orders.created_at',
        'orders.updated_at',
        'customers.id AS customer_id',
        'customers.person_id',
        'persons.firstname',
        'persons.lastname',
        'persons.email'
    ])
    ->join('customers', 'orders.customer_id = customers.id', 'left')
    ->join('persons', 'customers.person_id = persons.id', 'left');

        
            if (!empty($search)) {
                $query = $query->groupStart()
                    ->like('firstname', $search)
                    ->orLike('lastname', $search)
                    ->orLike('email', $search)
                    ->orLike('orders.order_status', $search)
                    ->orLike('total_amount', $search)
                    ->orLike("CONCAT(firstname, ' ', lastname)", $search)
                    ->groupEnd();
            }
            if ($sortField === 'status') {
                $query->orderBy('orders.order_status', $sortDirection);
            } elseif ($sortField === 'total_amount') {
                $query->orderBy('total_amount', $sortDirection);
            }

            $orderData = $query->paginate($perPage);
        $data = [
            'orders' => $orderData,
            'pager' => $this->orderModel->pager,
            'search' => $search,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection
        ];
        return view('orders/index', ['orders' => $data]);
    }


    public function show($id)
    {
        $data['orderDetails'] = $this->orderModel->getOrderWithDetails($id); 
        $data['customerDetails'] = $this->orderModel->getOrderWithCustomer($id); 
        if (!$data['orderDetails'] OR !$data['customerDetails']) {
            return redirect()->to('/orders')->with('error', 'Order not found');
        }
        return view('orders/show' ,$data);
    }
    public function view($id)
    {
        $data['orderDetails'] = $this->orderModel->getOrderWithDetails($id); 
        $data['customerDetails'] = $this->orderModel->getOrderWithCustomer($id); 
        return view('orders/view' ,$data);
    }
  

public function updateStatus($id = null)
{

    // Validate ID
    if (empty($id) || !is_numeric($id)) {
        return redirect()->to('/orders')->with('error', 'Invalid order ID');
    }

    // Validate order_status
    $orderStatus = $this->request->getPost('order_status') ?? 'pending';
    // $validStatuses = ['pending', 'processing', 'completed', 'cancelled', 'unpaid', 'shipped', 'paid'];
    // if (!in_array($orderStatus, $validStatuses)) {
    //     return redirect()->to('/orders')->with('error', 'Invalid order status');
    // }

    // Update the order status
    $data = [
        'order_status' => $orderStatus,
    ];
    $db = \Config\Database::connect();
    $db->table('orders')
        ->set($data)
        ->set('updated_at', date('Y-m-d H:i:s'))
        ->where('id', $id)
        ->update();

   if ($db->affectedRows() > 0) {
        return redirect()->to('order/show/' . $id)->with('success', "Order status {$data['order_status']} updated successfully");
    } else {
        return redirect()->to('order/show/' . $id)->with('error', 'Failed to update order status');
    }
}

}
// $db = \Config\Database::connect();
// $db->table('customers')
//     ->set($data)
//     ->set('updated_at', date('Y-m-d H:i:s'))
//     ->where('id', $id)
//     ->update();
