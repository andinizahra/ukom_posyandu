<?php

namespace App\Http\Controllers;

use App\Models\CatatanImunisasi;
use App\Models\Log;
use App\Models\CatatanVaksin;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('dashboard.index');
        
        if(auth()->user()->role == 'admin'){
            return view('dashboard.index');
        }
        if(auth()->user()->role == 'kader'){
          
            return view('dashboard.index');
        }
        if(auth()->user()->role == 'keluarga'){
            return view('dashboard.index');
        }
    }
}
