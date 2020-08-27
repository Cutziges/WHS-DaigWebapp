<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display the view for Settings
     */
    public function index(Request $request)
    {
        return view('settings.index');
    }
}
