<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EagerLoadingDemoController extends Controller
{
    public function __invoke(): View
    {
        DB::enableQueryLog();

        DB::flushQueryLog();
        $lazyProducts = Product::query()->orderBy('id')->limit(10)->get();
        $lazyRows = $lazyProducts->map(fn (Product $product) => [
            'name' => $product->name,
            'category' => $product->category->name,
            'owner' => $product->user->name,
        ]);
        $lazyLog = DB::getQueryLog();

        DB::flushQueryLog();
        $eagerProducts = Product::query()->with(['category', 'user'])->orderBy('id')->limit(10)->get();
        $eagerRows = $eagerProducts->map(fn (Product $product) => [
            'name' => $product->name,
            'category' => $product->category->name,
            'owner' => $product->user->name,
        ]);
        $eagerLog = DB::getQueryLog();

        DB::disableQueryLog();

        return view('demo.eager-loading', [
            'lazyRows' => $lazyRows,
            'eagerRows' => $eagerRows,
            'lazyCount' => count($lazyLog),
            'eagerCount' => count($eagerLog),
            'lazyQueries' => collect($lazyLog)->pluck('query')->take(5),
            'eagerQueries' => collect($eagerLog)->pluck('query'),
        ]);
    }
}
