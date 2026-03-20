<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComingSoonController extends Controller
{
    /**
     * Display the coming soon page
     */
    public function index()
    {
        return view('index');
    }
}
