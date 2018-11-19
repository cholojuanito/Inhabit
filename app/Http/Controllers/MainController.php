<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Get the landing page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('layouts.master', ['user' => $user]);
    }
}
