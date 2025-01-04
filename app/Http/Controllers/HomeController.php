<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function indexBudget()
    {
        return view('budget.index');
    }
    public function indexAccount()
    {
        return view('account.index');
    }
    public function indexTransaction()
    {
        return view('transaction.index');
    }
    public function indexDashboard()
    {
        return view('dashboard.index');
    }

    }
