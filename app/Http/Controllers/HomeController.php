<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Home;
use App\Models\HomeFeatures;
use App\Models\HomeReviews;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        $features = HomeFeatures::all();
        $testimonials = HomeReviews::all();
        $home = Home::first(); 

        return view('home', compact('carousels', 'features', 'testimonials', 'home'));
    }

}
