<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Merchant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $topMerchants = Merchant::with(['products', 'reviews'])
                ->where('status', 'active')
                ->orderBy('rating', 'desc')
                ->take(6)
                ->get();

            $categories = Category::withCount('products')
                ->orderBy('products_count', 'desc')
                ->take(6)
                ->get();

            return view('home.index', [
                'topMerchants' => $topMerchants,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            report($e); 
            return view('home.index', [
                'topMerchants' => collect(), 
                'categories' => collect(),
                'error' => 'Something went wrong while loading the homepage.',
            ]);
        }
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }
}
