<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::whereDoesntHaveRole('super_admin')->count();
        $offersCount = Offer::count();
        return view('admin.welcome', compact('usersCount', 'offersCount'));
    }
}
