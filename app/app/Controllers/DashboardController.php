<?php

namespace App\Controllers;

use App\Enums\PostStatus;
use App\Enums\UserStatus;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Enums\PorductStatus;
use App\Models\ProductModel;
use App\Enums\CustomerStatus;
use App\Models\CustomerModel;
use App\Models\OrderLineModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $modelUser = new UserModel();
        $modelCustomer = new CustomerModel();
        $modelOrder = new OrderModel();
        $modelproduct = new ProductModel();
        $modelOrderLine = new OrderLineModel();

        // Get the latest 4 customers and 5 products
         $latestCustomers = $modelUser->orderBy('created_at', 'desc')->limit(4)->findAll();
         $latestProducts = $modelproduct->orderBy('created_at', 'desc')->limit(5)->findAll();

        // Get the total number of active users, products, and customers
        // $activeUsers = $modelUser->where('status', value: UserStatus::Active->value)->countAllResults();
        $activeProducts = $modelproduct->where('status', value: PorductStatus::Active->value)->countAllResults();
        $activeCustomers = $modelCustomer->where('status', value: CustomerStatus::Active->value)->countAllResults();



        // Latest Users  
        $latestUsers = $modelUser->getLatestUsersWithPerson(5);

        // Orders with Customer and Order Details
        $ordersWithCustomer = $modelOrderLine->getAllOrderWithCustomer();
        $ordersWithDetails = $modelOrderLine->getAllOrderWithDetails();


        // Total Income
        $totalAmount = $modelOrder
        ->where('order_status', 'paid')
        ->selectSum('total_amount')
        ->get()
        ->getRow();
        $totalAmount = $totalAmount->total_amount ?? 0;
        $totalIncome = format_number($totalAmount);
      

        // Total Paid Orders
        $totalPaidOrders = $modelOrder
        ->where('order_status', 'paid')
        ->selectCount('id')
        ->get()
        ->getRow();
        $totalPaidOrders = $totalPaidOrders->id ?? 0;


        $data = [
            'title' => 'Dashboard',
            'activeCustomers' => $activeCustomers,
            'activeProducts' => $activeProducts,
            'latestUsers' => $latestUsers,
            'latestCustomers' => $latestCustomers,
            'latestProducts' => $latestProducts,
            'ordersWithCustomer' => $ordersWithCustomer,
            'ordersWithDetails' => $ordersWithDetails,
            'totalPaidOrders' => $totalPaidOrders,
            'totalIncome' => '€' . $totalIncome,
        ];
        return view('dashboard', $data);
    }
}
