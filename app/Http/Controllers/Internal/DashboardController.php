<?php

namespace App\Http\Controllers\Internal;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(): View {
        $titles = 'Internal Dashboard';
        return view('internal.dashboard.index', compact('titles'));
    }
}
