<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return view('dashboard', [
            'productCount' => Product::count(),
            'myProductCount' => $user->products()->count(),
            'myOrderCount' => $user->orders()->count(),
        ]);
    }
}
