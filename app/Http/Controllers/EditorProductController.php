<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class EditorProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['category', 'user'])->latest()->paginate(15);

        return view('editor.products.index', compact('products'));
    }
}
