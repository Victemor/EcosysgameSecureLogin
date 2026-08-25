<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DownloadController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard');
    }
}
