<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{

    public function index()
    {
        if (Auth::user()->email !== 'admin@email.com') {
            return redirect()->back()->with('erro', 'Sem permissão');
        }

        $logs = \App\Models\Log::with('user')->latest()->get();

        return view('logs.index', compact('logs'));
    }
}
