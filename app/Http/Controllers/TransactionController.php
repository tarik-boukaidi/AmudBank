<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Compte;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function faireTransactions(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'nom_complete' => 'required|string|max:255',
            'num_compte_destinataire' => 'required|string|max:255',
        ]);
        $compte = auth()->user()->comptes()->where('type_compte', $request->source)->first();
        if (!$compte) {
            return redirect()->back()->with('error', 'Compte source introuvable.');
        }
        Transaction::create([
            'user_id' => auth()->id(),
            'numero_carte' => $compte->numero_compte,
            'montant' => $request->montant,
            'compte_source' => $request->source,
            'description' => $request->description,
            'nom_complete' => $request->nom_complete,
            'numero_carte_destination' => $request->num_compte_destinataire,
        ]);
        Compte::where('user_id', auth()->id())
            ->where('numero_compte', $compte->numero_compte)
            ->decrement('solde', $request->montant);
        
        return redirect()->route('transactions')
            ->with('success', 'Transaction effectuée avec succès.');
        }


}
