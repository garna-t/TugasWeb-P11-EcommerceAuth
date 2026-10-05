<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class ManageController extends Controller
{
    public function index(): View
    {
        $users = User::withCount(['products', 'orders'])->orderBy('id')->paginate(15);

        return view('manage.index', [
            'users' => $users,
            'productCount' => Product::count(),
            'orderCount' => Order::count(),
        ]);
    }
}
