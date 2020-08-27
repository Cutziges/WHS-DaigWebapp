<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display the view for Impressum
     */
    public function impressum(Request $request)
    {
        return view('footer.impressum');
    }

    /**
     * Display the view for Terms and Conditions
     */
    public function terms(Request $request)
    {
        return view('footer.terms');
    }

    /**
     * Display the view for Privacy
     */
    public function privacy(Request $request)
    {
        return view('footer.privacy');
    }

    /**
     * Display the view for Login
     */
    public function admin()
    {
        $items = Item::all();
        return view('admin.index')->with('items', $items);
    }
}
