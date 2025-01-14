<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::take(5)->get(); // Produtos em destaque (os 5 primeiros)
        $products = Product::all(); // Todos os produtos
        return view('products.index', compact('featuredProducts', 'products'));
    }
    
}
