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
        $latestUsers = $modelUser->getLatestUsersWithPerson(5);


        
        $modelCustomer = new CustomerModel();
        $modelPost = new PostModel();
        $modelproduct = new ProductModel();
         $latestCustomers = $modelUser->orderBy('created_at', 'desc')->limit(4)->findAll();
         $latestProducts = $modelproduct->orderBy('created_at', 'desc')->limit(5)->findAll();
        // $activeUsers = $modelUser->where('status', value: UserStatus::Active->value)->countAllResults();
        $activeProducts = $modelproduct->where('status', value: PorductStatus::Active->value)->countAllResults();
        $activeCustomers = $modelCustomer->where('status', value: CustomerStatus::Active->value)->countAllResults();


        // Orders
        $modelOrderLine = new OrderLineModel();
        $ordersWithCustomer = $modelOrderLine->getAllOrderWithCustomer();
        $ordersWithDetails = $modelOrderLine->getAllOrderWithDetails();
        //  dd($ordersWithDetails);

//         $customersMap = [];
// foreach ($ordersWithCustomer as $customer) {
//     $customersMap[$customer['id']] = $customer; // 'id' is customers.id
// }


        // // $activePosts = $modelPost->where('state', PostStatus::Active->value)->countAllResults();
        $data = [
            'title' => 'Dashboard',
            'activeCustomers' => $activeCustomers,
             'activeProducts' => $activeProducts,
            'latestUsers' => $latestUsers,
            'latestCustomers' => $latestCustomers,
            'latestProducts' => $latestProducts,
            'ordersWithCustomer' => $ordersWithCustomer,
            'ordersWithDetails' => $ordersWithDetails,
            // 'customersMap' => $customersMap, // << pass this

        ];
        return view('dashboard', $data);
    }
    

    // public function activeUsers()
    // {
    //     return UserModel::where('status', UserStatus::Active->value)->count();
    // }
}
