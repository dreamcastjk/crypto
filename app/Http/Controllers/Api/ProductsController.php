<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Products list
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke(Request $request)
    {
        return Product::with('info')->paginate();
    }

    /**
     * Single product selected by id field
     *
     * @param Product $product
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function show(Product $product)
    {
        return $product::with('info')->first();
    }
}
