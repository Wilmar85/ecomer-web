<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Puedes agregar estadísticas o resúmenes aquí
        return view('admin.dashboard');
    }
}
