<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tuitionPostings = $user->tuitionPostings()->latest()->get();
        return view('dashboard.index', compact('tuitionPostings'));
    }
}

