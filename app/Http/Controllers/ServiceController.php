<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('pages.services');
    }
}
