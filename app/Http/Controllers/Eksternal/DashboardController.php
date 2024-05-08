<?php

namespace App\Http\Controllers\Eksternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View {
        $titles = 'Eksternal Dashboard';
        return view('eksternal.dashboard.index', compact('titles'));
    }
}
