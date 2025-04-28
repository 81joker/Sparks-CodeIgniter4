<?php namespace App\Controllers;

use App\Models\UserModel;

class Test extends BaseController
{
    public function joins()
    {
        $userModel = new UserModel();
        
        // Example queries
        $user = $userModel->find(1);
        $user = $userModel->find_by_email('test@example.com');
        $users = $userModel->find_all_by_status('active');
        
        // With relationships
        $userWithOrders = $userModel->with('orders')->find(1);
        
        // Complex query
        $users = $userModel
            ->select('users.*, COUNT(orders.id) as order_count')
            ->join('orders', 'users.id = orders.user_id', 'left')
            ->groupBy('users.id')
            ->orderBy('order_count', 'DESC')
            ->findAll();
            
        return $this->response->setJSON($users);
    }
}