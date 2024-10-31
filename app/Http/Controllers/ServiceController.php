<?php

namespace App\Http\Controllers;

use App\Models\ServiceContent;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $mainDescription = ServiceContent::first()->main_description;
        $services = Services::all();
        
        return view('services', compact('services', 'mainDescription'));
    }
}
