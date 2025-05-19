<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Delete_request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class operationController extends Controller
{
    public function showtransactions()
    {
        return view('transactions');
    }
    public function test(){
        return view('test');
    }
    public function showcredit()
    {
        return view('credit');
    }

    public function showcardinfo(Request $request)
    {  $id=$request->query('id');
        $compte = Compte::find($id);
        
        return view('cardinfo', compact('compte'));
    }

    public function showtransactionsHistory(Request $request)
    {
        $type_compte = $request->type_compte ?? ['courant', 'epargne', 'professionnel'];

        $transactions = auth()->user()
            ->transactions()
            ->whereIn('type_compte', (array) $type_compte)
            ->orderBy('created_at', 'desc')
            // ->take($request->time)
            ->paginate(6);

        return view('transactionsHistory', compact('transactions'));
    }


    public function showoverview()
    {    $comptes = Compte::where('user_id', auth()->id())->get();
            $transactions = auth()->user()
            ->transactions()
            ->whereIn('type_compte', ['courant', 'epargne', 'professionnel'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('Overview', compact('transactions', 'comptes'));
    }
    public function showaccounts()
    {    $comptes = Compte::where('user_id', auth()->id())->get();

        return view('accounts', compact('comptes'));
    }
    public function showsettings()
    {
        return view('Settings');
    }

    public function requestdelete(Request $request)
    {
        $user = Auth::user();
        Delete_request::create([
            'user_id' => auth()->id(),
            'motif' => $request->motif,
            'type_compte' => $request->type_compte,
            'reponse' => 'en_attente',
        ]);

        return redirect()->back()->with('success', 'Delete request submitted successfully.');
    }
}

