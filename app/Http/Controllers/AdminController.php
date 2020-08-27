<?php

namespace App\Http\Controllers;

use App\Tips;
use Illuminate\Http\Request;
use App\Item;
use App\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Event\DocumentParsedEvent;

class AdminController extends Controller
{
    /**
     * ================================================================
     *                         MAIN FUNCTIONS
     * ================================================================
     */

    /**
     * AdminController constructor.
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */


    /**
     * Show the adminpage view
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index');
    }
}
