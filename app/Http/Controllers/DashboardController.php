<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artigo;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_users' => User::count(),
            'total_orders' => Artigo::count(),
            'total_revenue' => Artigo::sum('total_amount'),
        ];

        $recent_orders = Artigo::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_orders'));
    }
}