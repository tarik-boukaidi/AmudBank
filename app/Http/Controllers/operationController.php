<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Carte;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class operationController extends Controller
{
    public function showtransactions()
    {
        return view('transactions');
    }
    public function showtransactionsHistory()
    {
        return view('transactionsHistory');
    }
    public function showoverview()
    {    $comptes = Compte::with('cartes')
        ->where('user_id', auth()->id())
        ->get();
        return view('Overview', compact('comptes'));
    }
    public function showaccounts()
    {
        $comptes = Compte::with('cartes')
        ->where('user_id', auth()->id())
        ->get();
        return view('accounts', compact('comptes'));
    }
    public function showsettings()
    {
        return view('Settings');
    }
}
