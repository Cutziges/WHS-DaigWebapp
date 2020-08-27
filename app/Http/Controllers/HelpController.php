<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display the view for Help
     */
    public function index(Request $request)
    {
        return view('help.index');
    }
}
