<?php

namespace App\Http\Controllers;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{   

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $citas = Cita::with('user')->get();
            return view('dashboard.admin', compact('citas'));
        }

        $citas = Cita::where('user_id', Auth::id())->get();
        return view('dashboard.client', compact('citas'));
    }

}
