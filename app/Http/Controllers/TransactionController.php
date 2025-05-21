<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function faireTransactions(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'nom_complete' => 'required|string|max:255',
            'num_compte_destinataire' => 'required|digits:7',

       ]);
        if($request->banque_destinataire == "AmudBank" && 
        $compte1 = Compte::where('numero_compte', $request->num_compte_destinataire)->first()){

        $compte = auth()->user()->comptes()->where('type_compte', $request->source)->first();
        if (!$compte) {
        return redirect()->back()->withErrors(['compte_source' => 'Compte source introuvable.']);
        }
        if ($compte->solde < $request->montant) {
        return redirect()->back()->withErrors(['fonds_insuffisants' => 'Fonds insuffisants.']);
        }
        $compte->solde -= $request->montant;
        $compte->save();
        $compte1->solde += $request->montant;
        $compte1->save();

        Transaction::create([
            'compte_id' => $compte->id,
            'numero_compte' => $compte->numero_compte,
            'montant' => $request->montant,
            'compte_source' => $request->source,
            'description' => $request->description,
            'nom_complete' => $request->nom_complete,
            'numero_compte_destination' => $request->num_compte_destinataire,
            
        ]);
        return redirect()->route('transactions')->with('success', 'Transaction effectuée avec succès.');
    }else{
        return redirect()->back()->withErrors(['banque_destinataire' => 'ce compte n\'existe pas.']);
     }
    }
        public function internalTransfer(Request $request)
    {
    $request->validate([
        'montant' => 'required|numeric|min:0.01',
        'source' => 'required|string|max:255',
        'compte_destinataire' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
    ]);

    // Prevent transferring to the same account
    if ($request->source === $request->compte_destinataire) {
        return redirect()->back()->withErrors(['same_account' => 'Vous ne pouvez pas transférer vers le même compte.']);
    }

    // Get the source account
    $sourceAccount = auth()->user()->comptes()->where('type_compte', $request->source)->first();
    if (!$sourceAccount) {
        return redirect()->back()->withErrors(['source' => 'Compte source introuvable.']);
    }

    // Check if source has enough balance
    if ($sourceAccount->solde < $request->montant) {
        return redirect()->back()->withErrors(['montant' => 'Fonds insuffisants.']);
    }

    // Get the destination account
    $destinationAccount = auth()->user()->comptes()->where('type_compte', $request->compte_destinataire)->first();
    if (!$destinationAccount) {
        return redirect()->back()->withErrors(['compte_destinataire' => 'Compte destinataire introuvable.']);
    }

    // Use a database transaction to ensure consistency
    DB::transaction(function () use ($request, $sourceAccount, $destinationAccount) {
        // Deduct from source
        $sourceAccount->solde -= $request->montant;
        $sourceAccount->save();

        $destinationAccount->solde += $request->montant;
        $destinationAccount->save();
        
        Transaction::create([
            'compte_id' => $sourceAccount->id,
            'numero_compte' => $sourceAccount->numero_compte,
            'montant' => $request->montant,
            'compte_source' => $request->source,
            'status' => 'terminée',
            'transaction_type' => 'virement',
            'description' => $request->description,
            'nom_complete' => auth()->user()->Nom . ' ' . auth()->user()->Prenom,
            'numero_compte_destination' => $destinationAccount->numero_compte,
        ]);
    });

    return redirect()->route('transactions')->with('success', 'Virement interne effectué avec succès.');
}


}
