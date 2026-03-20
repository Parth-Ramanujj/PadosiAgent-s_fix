<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ComingSoonController extends Controller
{
    /**
     * Display the coming soon page
     */
    public function index()
    {
        return view('coming-soon');
    }
}
